<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Product extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id');
            $table->longtext('images');
            $table->longtext('name'); 
            $table->longtext('slug');
            $table->longtext('metadata');
            $table->longtext('search_name');
            $table->longtext('description')->nullable();
            $table->longtext('detail')->nullable();
            $table->longtext('prices');
            $table->longtext('defaul_prices')->nullable();
            $table->integer('trending')->default(0);
            $table->integer('view')->default(0);
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
        Schema::dropIfExists('product');
    }
}
