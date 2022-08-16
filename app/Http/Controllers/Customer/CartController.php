<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Redirect,Response,Config;
use Mail;
use App\Mail\MailNotify;

use App\Repositories\CustomerRepository;
use App\Models\CustomerDetail;
use Carbon\Carbon;
use Session;
use Hash;
use DB;

class CartController extends Controller
{
    protected $customer_detail;

    public function __construct(CustomerDetail $customer_detail){
        $this->customer_detail  = new CustomerRepository($customer_detail);
    }

    // Lấy ra giỏ hàng
    public function get(Request $request){
        $is_user = static::check_token($request); 
        $route_redirect = "/";
        if ($is_user) { 
            list($user_id, $token) = static::unpack_token($request); 
            $cart = $this->customer_detail->get_cart($user_id)[0];
            return $this->customer_detail->send_response("Giỏ hàng", $cart, 200); 
        }else{
            return $this->customer_detail->send_response("Phiên đăng nhập hết hạn", $route_redirect, 404); 
        }
    }

    // Cập nhật giỏ hàng
    public function update(Request $request){
        $is_user = static::check_token($request); 
        $route_redirect = "/";
        if ($is_user) { 
            list($user_id, $token) = static::unpack_token($request); 
            $cart = $this->customer_detail->get_cart($user_id)[0];
            $data = $this->customer_detail->update(["cart" => $request->cart], $cart->id);
            return $this->customer_detail->send_response("Cập nhật thành công", $data, 200); 
        }else{
            return $this->customer_detail->send_response("Phiên đăng nhập hết hạn", $route_redirect, 404); 
        }
    }


    // Kiểm tra token hợp lệ
    public function check_token(Request $request){
        $token = $request->cookie('_token_');
        list($user_id, $token) = explode('$', $token, 2); 
        $user = $this->customer_detail->get_secret($user_id);
        if ($user) {
            return Hash::check($user_id . '$' . $user[0]->secret_key, $token);
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
