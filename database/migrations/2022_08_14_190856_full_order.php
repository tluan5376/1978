<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FullOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('full_order', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('shipper_id')->nullable();
            $table->integer('admin_id')->nullable();
            $table->integer('coupon_id')->nullable();
            $table->integer('customer_id')->nullable();
            $table->integer('sub_total');
            $table->integer('discount_total');
            $table->integer('total');
            $table->string('username');
            $table->string('email');
            $table->string('telephone');
            $table->string('address');
            $table->integer('payment_value'); 
            $table->integer('payment_status'); 
            $table->longtext('order_value'); 
            $table->integer('order_status');  
            $table->longtext('comment');
            $table->integer('status')->default(1);
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('full_order');
    }
}
