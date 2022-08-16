<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

use App\Repositories\Manager\ProductRepository;
use App\Models\Product\Product; 
use Carbon\Carbon;
use Session;
use Hash;
use DB;

class ProductController extends Controller
{
    protected $product;

    public function __construct(Product $product){
        $this->product             = new ProductRepository($product); 
    }
    public function index(){ 
       
        return view("admin.manager.product");
    }
    public function get(){
        $data = $this->product->get_data();
        return $this->product->send_response(201, $data, null);
    }
    public function get_one($id){
        $data = $this->product->get_one($id);
        return $this->product->send_response(200, $data, null);
    }
 
    public function store(Request $request){   
        $metadata = json_decode($request->data_meta)->data; 
        $search_value = [];
        foreach ($metadata as $key => $value) {
            array_push($search_value, reset( $value));
        }  
        $data = [
            "category_id"   => $request->data_category, 
            "name"          => $request->data_name,
            "slug"          => $this->product->to_slug($request->data_name), 
            "metadata"      => $request->data_meta,
            "search_name"   => $request->data_name . "/" . implode("/",$search_value),
            "description"   => nl2br($request->data_description ?? ""),
            "detail"        => $request->data_detail ?? "", 
            "prices"        => $request->data_prices,
            "defaul_prices"        => $request->data_defaul_prices,
        ];
        try {
            DB::beginTransaction();
            $image_list     = [];
            if ($request->image_list_length) {
                for ($i = 0; $i < $request->image_list_length; $i++) {  
                    array_push($image_list, $this->product->imageInventor('image-upload', $request['image_list_item_'.$i], 600)); 
                }
                $data['images'] = implode(",",$image_list);
            }
            $data_return = $this->product->create($data);
            DB::commit(); 
            return $this->product->send_response(201, $data_return, null);
        } catch (\Exception $exception) {
            DB::rollBack();
            $this->product->send_response(500, $exception, null);
        }
    }
    public function update(Request $request){  
        $metadata = json_decode($request->data_meta)->data; 
        $search_value = [];
        foreach ($metadata as $key => $value) {
            array_push($search_value, reset( $value));
        }  
        $data = [
            "category_id"   => $request->data_category, 
            "name"          => $request->data_name,
            "slug"          => $this->product->to_slug($request->data_name), 
            "metadata"      => $request->data_meta,
            "search_name"   => $request->data_name . "/" . implode("/",$search_value),
            "description"   => nl2br($request->data_description ?? ""),
            "detail"        => $request->data_detail ?? "", 
            "prices"        => $request->data_prices,
        ];
        try {
            DB::beginTransaction();
            $image_list     = []; 
            if ($request->data_images_preview) {
                $image_preview = explode(",", $request->data_images_preview);  
                for ($i = 0; $i < count($image_preview); $i++) {  
                    array_push($image_list, $image_preview[$i]); 
                }
            }
            if ($request->image_list_length) {
                for ($i = 0; $i < $request->image_list_length; $i++) { 
                    $image_name = $this->product->imageInventor('image-upload', $request['image_list_item_'.$i], 1200); 
                    array_push($image_list, $image_name); 
                }
            } 
            $data['images'] = implode(",",$image_list);
            $this->product->update($data, $request->data_id);
            DB::commit(); 
            return $this->product->send_response(201, "Update Success", null);
        } catch (\Exception $exception) {
            DB::rollBack();
            $this->product->send_response(500, $exception, null);
        } 
    }  
    public function delete($id){
        $this->product->delete($id); 
        return $this->product->send_response(200, "Delete successful", null);
    }
    // cập nhật trending
    public function update_trending(Request $request){
        $this->product->update_trending($request->id);
        return $this->product->send_response(200, null, null);
    }
}
