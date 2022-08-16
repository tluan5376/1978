<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

use App\Repositories\Manager\ProductRepository;
use App\Models\Product\Product; 

use App\Repositories\Manager\CategoryRepository;
use App\Models\Product\Category; 

use App\Repositories\Manager\DiscountRepository;
use App\Models\Product\Discount; 

use Carbon\Carbon;
use Session;
use Hash;
use DB;

class ProductController extends Controller
{
    protected $product; 
    protected $category; 
    protected $discount;

    public function __construct(Product $product, Category $category, Discount $discount){
        $this->product             = new ProductRepository($product);
        $this->category            = new CategoryRepository($category);
        $this->discount             = new DiscountRepository($discount); 
    }
    
    // Lấy ra sản phẩm theo request
    public function get_all(Request $request){
        $count = count($this->product->get_all_condition($request));

        $data_product = $this->product->get_condition($request, $count); 
        
        $data = [];
        foreach ($data_product as $key => $value) {
            $discount_value = $this->discount->find_discount_by_id($value->id);
            array_push($data, [
                "data_product"  => $value,
                "data_discount" => $discount_value == null ? 0 : $discount_value->percent,
            ]); 
        }

        $data_return = [
            "category"  => $request->tag != 0 ? $this->category->get_one($request->tag)[0] : "All",
            "data"      => $data,
            "count"     => $count,
        ];
        return $this->product->send_response(200, $data_return, null);
    }
    // Lấy ra 1 sản phẩm
    public function get_one(Request $request, $id){
        // list($user_id, $token) = static::unpack_token($request);  
        // list($id, $authen) = explode('-', $id, 2);
        // list($user_id, $token) = explode('$', $request->cookie('_token_'), 2);
        // $hasView = $this->product->find_view_history($user_id, $id);
        // if (count($hasView) != 0) {
        //     $this->view_history->update_view($hasView[0]->id);
        // }else{
        //     $view_data = [
        //         "customer_id"   => $user_id,
        //         "product_id"    => $id,
        //         "time_view"     => 1,
        //         "status"        => $authen,
        //     ];
        //     $this->view_history->create($view_data);
        // }
        $data_product = $this->product->get_one($id);
        $discount_value = $this->discount->find_discount_by_id($id);
        // $data_rate = $this->comment->get_rate($id);
        $data = [
            "data_product"  => $data_product,
            "data_discount" => $discount_value == null ? 0 : $discount_value->percent,
            // "data_rate"     => $data_rate,
        ];
        // $data = $this->product->get_one($id);
        return $this->product->send_response(200, $data, null);
    }
    // lấy ra 5 sản phẩm của danh mục
    public function get_item_category($id){
        $data_product = $this->product->get_item_category($id);
        $data_type  = $this->category->get_type($id);
        $data = [
            "product"   => $data_product,
            "type"      => $data_type,
        ];
        return $this->product->send_response(200, $data, null);
    }
    // Lấy ra 1 sản phẩm - giỏ hàng
    public function get_one_cart($id){ 
        $data = [
            "data_product"  => $this->product->get_one($id),
            "data_discount" => $this->discount->find_discount_by_id($id),
        ]; 
        return $this->product->send_response("Thành công", $data, 200);
    }


    // lấy ra sản phẩm mới
    public function get_new_arrivals(){
        $data_product = $this->product->get_new_arrivals(8);
        $data = [];
        foreach ($data_product as $key => $value) {
            $discount_value = $this->discount->find_discount_by_id($value->id);
            array_push($data, [
                "data_product"  => $value,
                "data_discount" => $discount_value == null ? 0 : $discount_value->percent,
            ]); 
        }
        return $this->product->send_response(200, $data, null);
    }
    // Lấy ra sản phẩm giảm giá
    public function get_discount_item(){
        $data_product = $this->product->get_discount_item(8);
        $data = [];
        foreach ($data_product as $key => $value) {
            $discount_value = $this->discount->find_discount_by_id($value->id);
            array_push($data, [
                "data_product"  => $value,
                "data_discount" => $discount_value == null ? 0 : $discount_value->percent,
            ]); 
        }
        return $this->product->send_response(200, $data, null);
    }
    // Index - lấy ra sản phẩm giảm giá mạnh nhất
    public function get_best_discount(){
        $data = $this->product->get_best_discount(); 
        return $this->product->send_response(200, $data, null);
    }
    // Index - lấy ra sản phẩm giảm giá mạnh nhất
    public function get_quick_discount(){
        $data = $this->product->get_quick_discount(12); 
        return $this->product->send_response(200, $data, null);
    } 
    // lấy ra sản phẩm liên quan
    public function get_related($id){
        $product = $this->product->get_one($id); 
        $data_product = $this->product->get_related($product->category_id, $id, 6);
        $data = [];
        foreach ($data_product as $key => $value) {
            $discount_value = $this->discount->find_discount_by_id($value->id);
            array_push($data, [
                "data_product"  => $value,
                "data_discount" => $discount_value == null ? 0 : $discount_value->percent,
            ]); 
        }
        return $this->product->send_response(200, $data, null);
    }
    // Lấy ra sản phẩm trending carousel
    public function get_trending(){
        $data = $this->product->get_trending();
        return $this->product->send_response(200, $data, null);
    }
    public function get_search(Request $request){
        $text = $request->data_text;
        $category = $request->data_category;
        $slug_data = $this->product->to_slug($text);
        $data = $this->product->find_real_time($slug_data, $category);
        return $this->product->send_response(200, $data, null);
    }








    // Lấy ra lịch sử xem sản phẩm
    public function get_recently(Request $request, $item){
        $items = explode(",", $item);
        $data = [];
        foreach ($items as $key => $value) {
            array_push($data, $this->product->get_one($value)[0]);
        }
        return $this->product->send_response(200, $data, null);
    }
    
    // Kiểm tra token hợp lệ
    public function check_token(Request $request){
        $token = $request->cookie('_token_');
        list($user_id, $token) = explode('$', $token, 2); 
        $user = $this->customer->get_secret($user_id);
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
