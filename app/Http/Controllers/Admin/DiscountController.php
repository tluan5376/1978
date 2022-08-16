<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

use App\Repositories\Manager\ProductRepository;
use App\Models\Product\Product; 

use App\Repositories\Manager\DiscountRepository;
use App\Models\Product\Discount; 
use Carbon\Carbon;
use Session;
use Hash;
use DB;

class DiscountController extends Controller
{
    protected $product; 
    protected $discount;

    public function __construct(Product $product, Discount $discount){
        $this->discount             = new DiscountRepository($discount); 
        $this->product             = new ProductRepository($product);
    }
    public function index(){
        return view("admin.manager.discount");
    }
    public function get(){
        $data = $this->discount->get_data();
        return $this->discount->send_response(201, $data, null);
    } 
    public function get_discount(){
        $data_product = $this->product->get_data();
        $data = [];
        foreach ($data_product as $key => $value) {
            $discount_value = $this->discount->find_discount_by_id($value->id);
            array_push($data, [
                "data_product"  => $value,
                "data_discount" => $discount_value == null ? 0 : $discount_value->percent,
            ]); 
        } 
        return $this->discount->send_response(201, $data, null);
    } 
    public function store(Request $request){     
        $data = [ 
            "product_id"    => $request->data_category,  
            "percent"       => $request->data_percent,  
            "type"          => $request->data_type,  
            "time_end"      => $request->data_time_end,  
        ];
        $data_create = $this->discount->create($data); 
        return $this->discount->send_response("Create successful", $data_create, 201);
    }
    public function delete($id){
        $this->discount->remove_discount($id); 
        return $this->discount->send_response(200, "Delete successful", null);
    }
}
