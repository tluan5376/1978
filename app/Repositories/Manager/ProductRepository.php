<?php

namespace App\Repositories\Manager;

use Illuminate\Database\Eloquent\Model;
use App\Repositories\BaseRepository;
use App\Repositories\RepositoryInterface;
use Session;
use Hash;
use DB;

class ProductRepository extends BaseRepository implements RepositoryInterface
{
    protected $model;

    public function __construct(Model $model){
        $this->model = $model;
    }

    public function get_data(){ 
        return DB::table('product')
                ->select('product.*', 'category.name as category_name')
                ->leftjoin('category', 'product.category_id', '=', 'category.id')
                ->get(); 
    } 
    public function get_one($id){ 
        return DB::table('product') 
                ->select("product.*", 'category.name as category_name', 'category.image as category_image') 
                ->leftjoin('category', 'product.category_id', '=', 'category.id')
                ->where([["product.id", "=", $id]]) 
                ->first(); 
    }
    public function update_trending($id){
        $sql = 'UPDATE product set trending = !trending WHERE id = '.$id;
        DB::select($sql);
    }










    public function get_all_condition($request){
        $category_id    = $request->tag;
        $keyword        = $request->keyword;
        $sort           = $request->sort;
        list($prices_from, $prices_to) = explode(';', $request->prices, 2);
        if ($request->status == "sale") {
            return DB::table('discount') 
                ->select("product.*", 'category.name as category_name')
                ->leftjoin("product", "product.id", "=", "discount.product_id") 
                ->leftjoin('category', 'product.category_id', '=', 'category.id')
                ->where([
                            ["discount.percent", "<>", "0"], 
                            ["discount.status", "<>", "0"]
                        ]) 
                // ->whereBetween('product.prices', [$prices_from, $prices_to])
                ->get(); 
        }else{
            return DB::table('product') 
                ->select("product.*", 'category.name as category_name') 
                ->leftjoin('category', 'product.category_id', '=', 'category.id') 
                ->when($category_id > 0, function ($query) use ($category_id) {
                    return $query->where('product.category_id', $category_id);
                }) 
                ->when($keyword != "", function ($query) use ($keyword) {
                    $query->where('product.search_name', "like", "%".$keyword."%");
                })  
                // ->whereBetween('product.prices', [$prices_from, $prices_to])
                ->get(); 
        } 
    }
    public function get_condition($request, $count){
        $category_id    = $request->tag;
        $keyword        = $request->keyword;
        $sort           = $request->sort;
        $page           = $request->page;
        $pageSize       = $request->pageSize;
        list($prices_from, $prices_to) = explode(';', $request->prices, 2); 
        if ($request->status == "sale") {
            return DB::table('discount') 
                ->select("product.*", 'category.name as category_name')
                ->leftjoin("product", "product.id", "=", "discount.product_id") 
                ->leftjoin('category', 'product.category_id', '=', 'category.id')
                ->where([
                            ["discount.percent", "<>", "0"], 
                            ["discount.status", "<>", "0"]
                        ]) 
                // ->whereBetween('product.prices', [$prices_from, $prices_to])
                ->get(); 
        }else{ 
            return DB::table('product') 
                ->select("product.*", 'category.name as category_name') 
                ->leftjoin('category', 'product.category_id', '=', 'category.id') 
                ->when($category_id > 0, function ($query) use ($category_id) { 
                    $query->where('product.category_id', "=", $category_id); 
                }) 
                ->when($keyword != "", function ($query) use ($keyword) {
                    $query->where('product.search_name', "like", "%".$keyword."%");
                }) 
                ->when($sort == "1", function ($query) {
                    $query->orderByDesc('product.created_at');
                }) 
                ->when($sort == "2", function ($query) {
                    $query->orderBy('product.name');
                }) 
                ->when($sort == "3", function ($query) {
                    $query->orderByDesc('product.name');
                }) 
                ->when($sort == "4", function ($query) {
                    $query->orderBy('product.prices');
                }) 
                ->when($sort == "5", function ($query) {
                    $query->orderByDesc('product.prices');
                }) 
                // ->where([['product.prices', ">=", $prices_from], ['product.prices', "<=", $prices_to]])
                // ->whereBetween('product.prices', [$prices_from, $prices_to])
                ->offset(($page-1) * $pageSize)
                ->limit($pageSize)
                ->get(); 
        } 

        // $category_id    = $request->tag;
        // $keyword        = $request->keyword;
        // $page           = $request->page;
        // $pageSize       = $request->pageSize;
        // list($prices_from, $prices_to) = explode(';', $request->prices, 2);
        // $sort           = $request->sort;
        // $status         = $request->status;
        // $where_sql      = "";

        // if ($category_id > 0) $where_sql = " AND category_id = ".$category_id;
        // if ($keyword != "") $where_sql = " AND name like '".$category_id."'";
        // if ($status == "new") {
        //     $where_sql = " ORDER BY created_at DESC";
        // }else if ($status == "sale") {
        //     $where_sql = " AND discount <> 0";
        // }
        // $sort_by = "";
        // if ($sort == 1) {
        //     $sort_by = " ORDER BY created_at DESC";
        // }else if($sort == 2){
        //     $sort_by = " ORDER BY name ASC";
        // }else if($sort == 3){
        //     $sort_by = " ORDER BY name DESC";
        // }else if($sort == 4){
        //     $sort_by = " ORDER BY prices ASC";
        // }else if($sort == 5){
        //     $sort_by = " ORDER BY prices DESC";
        // }
        // $offset = $page == 1 ? "" : " OFFSET ".(($page-1) * $pageSize);

        // $sql = "SELECT *
        //         FROM product 
        //         WHERE prices BETWEEN ".$prices_from." AND ".$prices_to.$where_sql.$sort_by."
        //         LIMIT ".$pageSize.$offset;
        
        // return DB::select($sql);
    }
    public function get_new_arrivals($limit){ 
        return DB::table('product')
                ->select('product.*', 'category.name as category_name', 'category.name as category_name')
                ->leftjoin('category', 'product.category_id', '=', 'category.id') 
                ->orderByDesc('product.created_at')
                ->limit($limit)
                ->get(); 
    } 
    public function get_discount_item($limit){ 
        return DB::table('discount') 
                ->select("product.*", 'category.name as category_name')
                ->leftjoin("product", "product.id", "=", "discount.product_id") 
                ->leftjoin('category', 'product.category_id', '=', 'category.id')
                ->where([["discount.percent", "<>", "0"], ["discount.status", "<>", "0"]])
                ->orderByDesc('discount.percent')
                ->limit($limit)
                ->get(); 
    } 
    public function get_best_discount(){ 
        return DB::table('discount') 
                ->select("product.*", 'category.name as category_name', 'discount.percent as discount_percent', 'discount.time_end as discount_time_end')
                ->leftjoin("product", "product.id", "=", "discount.product_id") 
                ->leftjoin('category', 'product.category_id', '=', 'category.id')
                ->where([["discount.percent", "<>", "0"], ["discount.status", "<>", "0"], ["discount.type", "=", "1"]])
                ->orderByDesc('discount.percent') 
                ->first(); 
    } 
    public function get_quick_discount($limit){ 
        return DB::table('discount') 
                ->select("product.*", 'category.name as category_name', 'discount.percent as discount_percent', 'discount.time_end as discount_time_end')
                ->leftjoin("product", "product.id", "=", "discount.product_id") 
                ->leftjoin('category', 'product.category_id', '=', 'category.id')
                ->where([["discount.percent", "<>", "0"], ["discount.status", "<>", "0"], ["discount.type", "=", "1"]])
                ->orderByDesc('discount.percent') 
                ->limit($limit)
                ->get(); 
    } 
    public function get_trending(){ 
        return DB::table('product') 
                ->select("product.*", 'category.name as category_name') 
                ->leftjoin('category', 'product.category_id', '=', 'category.id')
                ->where([["product.trending", "=", "1"]])
                ->orderByDesc('product.updated_at')  
                ->get(); 
    }
    public function get_related($category_id, $id, $limit){ 
        return DB::table('product') 
                ->select("product.*", 'category.name as category_name') 
                ->leftjoin('category', 'product.category_id', '=', 'category.id')
                ->where([["product.category_id", "=", $category_id], ["product.id", "<>", $id]])
                ->orderByDesc('product.updated_at')  
                ->limit($limit)
                ->get();
    }
    public function find_real_time($slug, $category){
        $where_category = $category == 0 ? "" : " AND category_id = ".$category;
        $sql = "SELECT *
                FROM product 
                WHERE search_name like '%".$slug."%'".$where_category."
                LIMIT 5";
        return DB::select($sql);
    }
    
}
