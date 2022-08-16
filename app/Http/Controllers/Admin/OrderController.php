<?php

namespace App\Http\Controllers\Admin;

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

use App\Repositories\Manager\WarehouseRepository;
use App\Models\Product\Warehouse;

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
    protected $warehouse;

    public function __construct(Product $product, CustomerAuth $customer, FullOrder $order, OrderDetail $order_detail, Warehouse $warehouse){
        $this->customer         = new CustomerRepository($customer);
        $this->order            = new OrderRepository($order);
        $this->order_detail     = new OrderRepository($order_detail); 
        $this->product          = new ProductRepository($product);
        $this->warehouse        = new WarehouseRepository($warehouse);
    }
    public function index(){
        return view("admin.manager.order");
    }
    public function get(Request $request){
        $tab = $request->id;
        $order = $this->order->get_all($tab);
        return $this->order->send_response("Danh sách đơn hàng", $order, 200); 
    }
    public function get_one(Request $request){
        $order = $this->order->get_one($request->id);
        $order_detail = $this->order->get_detail($request->id);
        $order_group = [
            "order"         => $order,
            "order_detail"  => $order_detail,
        ];
        return $this->order->send_response("Danh sách đơn hàng", $order_group, 200); 
    }
    public function update(Request $request){
        $order_id       = $request->data_id;
        $order_status   = $request->data_status;
        $message_user   = [
            "",
            "Cửa hàng đang nhập hàng",
            "Đã xác nhận đơn hàng",
            "Đã chuẩn bị hàng - shipper đang lấy hàng", 
            "Shipper đang vận chuyển",
            "Đã nhận hàng",
            "Đơn hàng kết thúc, cảm ơn bạn đã mua hàng",
            "Đã hủy",
        ];
        $order = $this->order->get_one($order_id);
        $order_message_array = explode(",",$order[0]->order_value);
        array_push($order_message_array, Carbon::now()->toDateTimeString() . "|" . $message_user[$order_status]);
        $data = ["order_value" => implode(",",$order_message_array)];
        $this->order->update(["order_value" => implode(",",$order_message_array), "order_status" => $order_status], $order_id); 
         
        if ($request->data_status == 1) { 
            $this->order->update(["order_status" => $request->data_status], $request->data_id);
        }else if ($request->data_status == 2) { 
            $this->order->update(["order_status" => $request->data_status], $request->data_id);
        }else if ($request->data_status == 3) {
            $data_sub = $this->order_detail->get_full_order($request->data_id);
            foreach ($data_sub as $key => $value) {
                $warehouse_item = $this->warehouse->warehouse_get_item($value->product_id); 
                if (count($warehouse_item) > 0) {
                    $warehouse_quantity = $warehouse_item[0]->quantity;
                    $warehouse_reserve  = $warehouse_item[0]->reserve;
                    $item_reserve       = $value->quantity;
                    if ($warehouse_quantity > $item_reserve) {
                        $this->warehouse->update_item($value->product_id, $warehouse_quantity -= $item_reserve, $warehouse_reserve += $item_reserve);
                    }else{
                        return $this->order->send_response(500, null, "Hết sản phẩm");
                    }
                }else{
                    return $this->order->send_response(500, null,  "Không tồn tại sản phẩm");
                }
            }
            $this->order->update(["order_status" => $request->data_status], $request->data_id); 
        }else if ($request->data_status == 4) {
            // Customer hệ thống gán shipper 
            $this->order->update(["order_status" => $request->data_status], $request->data_id);
        }else if ($request->data_status == 5) {
            // Giao hàng thành công
            $this->order->update(["order_status" => $request->data_status], $request->data_id);
        }else if ($request->data_status == 6) {
            // Kết thúc đơn hàng
            $this->order->update(["order_status" => $request->data_status], $request->data_id);
        }else if ($request->data_status == 7) { 
            $data_sub = $this->order_detail->get_full_order($request->data_id);
            foreach ($data_sub as $key => $value) {
                $warehouse_item = $this->warehouse->warehouse_get_item($value->product_id);
                $warehouse_quantity = $warehouse_item[0]->quantity;
                $warehouse_reserve  = $warehouse_item[0]->reserve;
                $item_reserve       = $value->quantity;
                if (count($warehouse_item) > 0 && $warehouse_item[0]->quantity > $value->quantity) {
                    $this->warehouse->update_item($value->product_id, $warehouse_quantity += $item_reserve, $warehouse_reserve -= $item_reserve);
                }else{
                    return $this->order->send_response(500, null, null);
                }
            }
            $this->order->update(["order_status" => $request->data_status], $request->data_id);
        }

        return $this->order->send_response("Cập nhật thành công", null, 200); 
    }


    // Statistic
    public function get_total(){
        $turnover = $this->order->get_turnover();
        $item_sell = $this->order->get_item_sell();
        $order_time = $this->order->get_order_time();
        $customer_buy = $this->order->get_customer_buy();

        $data = [
            "turnover"  => $turnover,
            "item_sell"  => $item_sell,
            "order_time"  => $order_time,
            "customer_buy"  => $customer_buy,
        ];
        return $data;
    }
    public function get_best_sale(){
        $best_sale = $this->order->get_best_sale();
        return $best_sale;
    }
    public function get_customer(){
        $customer_new = $this->order->get_customer_new();
        $customer_free = $this->order->get_customer_free();
        $data = [
            "customer_new"  => $customer_new,
            "customer_free"  => $customer_free,
        ];
        return $data;
    }

}
