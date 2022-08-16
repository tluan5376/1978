<?php

namespace App\Repositories\Manager;

use Illuminate\Database\Eloquent\Model;
use App\Repositories\BaseRepository;
use App\Repositories\RepositoryInterface;
use Session;
use Hash;
use DB;

class OrderRepository extends BaseRepository implements RepositoryInterface
{
    protected $model;

    public function __construct(Model $model){
        $this->model = $model;
    }
    public function get_full_order($id){
        $sql = " SELECT order_detail.*, 
                        product.name, 
                        product.id as product_id,
                        warehouse.quantity as warehouse_quatity
                FROM order_detail
                LEFT JOIN product
                ON product.id = order_detail.product_id
                LEFT JOIN warehouse
                ON product.id = warehouse.product_id
                WHERE order_id = ".$id;
        return DB::select($sql);
    }
    public function get_in_order($id){
        $sql = " SELECT *
                    FROM order_time
                    WHERE id = ".$id;
        return DB::select($sql);
    }
    public function update_status($id){
        $sql = "UPDATE order_detail
                SET suborder_status = 1
                WHERE order_id = ".$id;
        return DB::select($sql);
    }

    
    public function get_all($tag){
        $status_order = $tag == null ? "" : " WHERE order_status = ".$tag;
        $sql = "SELECT *
                    FROM full_order ".$status_order." 
                    ORDER BY created_at DESC";
        return DB::select($sql);
    }
    public function get_detail($id){
        $sql = "SELECT order_detail.*,
                        product.name,
                        product.images ,
                        product.prices as product_prices ,
                        product.defaul_prices as product_defaul_prices ,
                        warehouse.quantity as warehouse_quatity
                    FROM order_detail 
                    LEFT JOIN product
                    ON product.id = order_detail.product_id
                    LEFT JOIN warehouse
                    ON product.id = warehouse.product_id
                    WHERE order_detail.order_id = ".$id;
        return DB::select($sql);
    }
    public function get_one($id){
        $sql = "SELECT full_order.*, customer_detail.avatar
                    FROM full_order 
                    LEFT JOIN customer_detail
                    ON customer_detail.customer_auth_id = full_order.customer_id
                    WHERE full_order.id = ".$id;
        return DB::select($sql);
    } 
    public function remove_cart($customer_id){
        $sql = "UPDATE customer_detail
                    SET cart = null
                    WHERE customer_auth_id = ".$customer_id;
        return DB::select($sql);
    }



    public function get_turnover(){
        $sql = " SELECT sum(total) as total
                    FROM full_order
                    WHERE order_status = 5";
        return DB::select($sql);
    }
    public function get_item_sell(){
        $sql = " SELECT sum(quantity) as total
                    FROM full_order
                    LEFT JOIN order_detail
                    ON full_order.id = order_detail.order_id
                    WHERE order_status = 5";
        return DB::select($sql);
    }
    public function get_order_time(){
        $sql = " SELECT count(*) as total
                    FROM full_order
                    WHERE order_status = 5";
        return DB::select($sql);
    }
    public function get_customer_buy(){
        $sql = " SELECT count(customer_id) as total
                    FROM full_order
                    WHERE order_status = 5
                    GROUP BY customer_id";
        return DB::select($sql);
    }
    public function get_best_sale(){
        $sql = " SELECT order_detail.product_id, 
                        sum(order_detail.quantity) as total, 
                        warehouse.quantity,
                        product.name,
                        product.images
                    FROM full_order
                    LEFT JOIN order_detail
                    ON full_order.id = order_detail.order_id
                    LEFT JOIN warehouse
                    ON warehouse.product_id = order_detail.product_id
                    LEFT JOIN product
                    ON order_detail.product_id = product.id
                    WHERE order_status = 3
                    GROUP BY order_detail.product_id, 
                            warehouse.quantity,
                            product.name,
                            product.images
                    ORDER BY total DESC LIMIT 5";
        return DB::select($sql);
    }
    
}
