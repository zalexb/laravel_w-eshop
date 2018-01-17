<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('goods',function (Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->float('price')->unsigned();
            $table->float('old_price')->unsigned()->nullable()->default(null);
            $table->float('discount_percent')->unsigned()->nullable()->default(null);
            $table->string('description',3000);
            $table->integer('rating')->unsigned()->nullable()->default(null);
            $table->string('brand');
            $table->integer('stock')->unsigned()->nullable()->default(null);
            $table->integer('case_width_approx_mm')->unsigned();
            $table->integer('case_depth_approx_mm')->unsigned();
            $table->integer('main_id_img')->unsigned()->nullable()->default(null);
            $table->foreign('main_id_img')->references('id')->on('images');
            $table->string('case_material');
            $table->integer('water_resistancy_m')->unsigned();
            $table->string('guarantee')->nullable()->default(null);
            $table->string('color');
            $table->integer('public')->nullable()->default(null);
            $table->string('MPN');
            $table->string('alias',500)->nullable()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('goods');
    }
}
