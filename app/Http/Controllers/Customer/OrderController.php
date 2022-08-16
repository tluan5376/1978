<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

use App\Repositories\CustomerRepository;
use App\Models\Customer\CustomerAuth;

use App\Repositories\Manager\OrderRepository;
use App\Models\Product\FullOrder;
use App\Models\Product\OrderDetail; 

use App\Repositories\Manager\ProductRepository;
use App\Models\Product\Product;

use App\Repositories\Manager\DiscountRepository;
use App\Models\Product\Discount; 

use Carbon\Carbon;
use Session;
use Hash;
use DB;

class OrderController extends Controller
{
    protected $product;
    protected $customer;
    protected $order;
    protected $order_detail;
    protected $discount;

    public function __construct(Product $product, CustomerAuth $customer, FullOrder $order, OrderDetail $order_detail, Discount $discount){
        $this->customer         = new CustomerRepository($customer);
        $this->order            = new OrderRepository($order);
        $this->order_detail     = new OrderRepository($order_detail); 
        $this->product          = new ProductRepository($product);
        $this->discount             = new DiscountRepository($discount); 
    }

    // Lấy ra danh sách đơn hàng
    public function get(Request $request){
        $is_user = static::check_token($request); 
        $route_redirect = "/";
        if ($is_user) { 
            $tab = $request->tab;
            list($user_id, $token) = static::unpack_token($request); 
            $data   = [];
            $order = $this->order->get_all($tab);
            foreach ($order as $key => $value) {
                $order_detail = $this->order->get_detail($value->id);
                $order_group = [
                    "order"         => $value,
                    "order_detail"  => $order_detail,
                ];
                array_push($data, $order_group);
            }
            return $this->order->send_response("Danh sách đơn hàng", $data, 200); 
        }else{
            return $this->order->send_response("Phiên đăng nhập hết hạn", $route_redirect, 404); 
        } 
    }

    // Đặt hàng
    public function checkout(Request $request){
        
        $is_user = static::check_token($request); 
        $route_redirect = "/";
        if ($is_user) { 
            list($user_id, $token) = static::unpack_token($request); 
        } 
        $payment    = $request->data_payment;
        $name       = $request->data_name;
        $address    = $request->data_address;
        $phone      = $request->data_phone;
        $email      = $request->data_email;
        $item       = explode(",",$request->data_cart);
        $quantity   = explode(",",$request->data_quantity);

        $sub_total  = 0;
        $discount   = 0;
        $total      = 0;

        $sub_order  = array();

        foreach ($item as $key => $item_id) {
            $product = $this->product->get_one($item_id);
            $discount_value = $this->discount->find_discount_by_id($item_id);
            $discount = $discount_value == null ? 0 : $discount_value->percent;
            if ($product) { 
                $discount_product   = $product->prices * $discount / 100;
                $sub_total          += $quantity[$key] * $product->prices;
                $discount           += $quantity[$key] * $discount_product;
                $data_sub_order = [
                    "order_id"      => 0,
                    "product_id"    => $item_id,
                    "quantity"      => $quantity[$key] ,
                    "prices"        => $product->prices,
                    "discount"      => $discount,
                    "total_price"   => $quantity[$key] * ($product->prices - $discount_product),
                    "shipping_quantity"  => 0,
                    "shipping_status"      => 0,
                ];
                array_push($sub_order, $data_sub_order);
            }
        }
        $total = $sub_total - $discount;

        $data_order = [
            "customer_id"       => $user_id ?? 0,
            "sub_total"         => $sub_total,
            "discount_total"    => $discount,
            "total"             => $total,
            "username"          => $name,
            "email"             => $email,
            "telephone"         => $phone,
            "address"           => $address,
            "order_value"       => Carbon::now()->toDateTimeString() . "|Đặt hàng thành công",
            "order_status"      => 0,
            "payment_value"     => $payment,
            "payment_status"    => 0,
            "comment"           => "",
        ];
        $order_item = $this->order->create($data_order);

        foreach ($sub_order as $key => $value) {
            $value["order_id"] = $order_item->id;
            $this->order_detail->create($value);
        }
        // $this->order->remove_cart($user_id);
        if ($payment == 1) {
            $route_redirect = "/profile?tab=Order";
            return $this->order->send_response("Đặt hàng thành công", $route_redirect, 200); 
        }else{
            $route_redirect = static::create_pay($request, $total, $order_item->id); 
            return $this->order->send_response("Đặt hàng thành công, chuyển hướng đến VNPay", $route_redirect, 200); 
        }
    }

    public function create_pay($request, $prices, $order_id){  

        session(['url_prev' => '/profile', 'item_id' => $order_id]);

        $vnp_TmnCode = "6NE7KUNZ"; //Mã website tại VNPAY 
        $vnp_HashSecret = "USUYDLXTCYCNCTNTVRUCQCJBUIELNVGF"; //Chuỗi bí mật
        $vnp_Url = "http://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://localhost:8000/return-vnpay";
        $vnp_TxnRef = date("YmdHis"); //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = "Thanh toán hóa đơn phí dich vụ";
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = $prices * 100;
        $vnp_Locale = 'vn';
        $vnp_IpAddr = request()->ip();

        $inputData = array(
            "vnp_Version"   => "2.0.0",
            "vnp_TmnCode"   => $vnp_TmnCode,
            "vnp_Amount"    => $vnp_Amount,
            "vnp_Command"   => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode"  => "VND",
            "vnp_IpAddr"    => $vnp_IpAddr,
            "vnp_Locale"    => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef"    => $vnp_TxnRef,
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . $key . "=" . $value;
            } else {
                $hashdata .= $key . "=" . $value;
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
           // $vnpSecureHash = md5($vnp_HashSecret . $hashdata);
            $vnpSecureHash = hash('sha256', $vnp_HashSecret . $hashdata);
            $vnp_Url .= 'vnp_SecureHashType=SHA256&vnp_SecureHash=' . $vnpSecureHash;
        }
        return $vnp_Url;
    }

    // Kiểm tra token hợp lệ
    public function check_token(Request $request){
        $token = $request->cookie('_token_');
        if ($token) {
            list($user_id, $token) = explode('$', $token, 2); 
            $user = $this->customer->get_secret($user_id); 
            if ($user) {
                return Hash::check($user_id . '$' . $user->secret_key, $token);
            }else{
                return false;
            }
        }else{
            return false;
        }
        
    }

    // Tách token
    public function unpack_token(Request $request){
        $token = $request->cookie('_token_');
        return explode('$', $token, 2); 
    }
}
