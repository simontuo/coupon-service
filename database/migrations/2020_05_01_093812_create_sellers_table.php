<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sellers', function (Blueprint $table) {
            $table->id();
            $table->string('seller_id')->comment('卖家id');
            $table->string('shop_name')->comment('店铺名称');
            $table->string('wean_wang_name')->comment('旺旺名称');
            $table->timestamps();
        });

        \DB::statement("ALTER TABLE `sellers` comment '卖家表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sellers');
    }
}
