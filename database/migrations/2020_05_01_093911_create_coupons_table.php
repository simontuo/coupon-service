<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('goods_id')->comment('商品id');
            $table->string('coupon_id')->comment('优惠券id');
            $table->unsignedInteger('total_amount')->comment('总量');
            $table->unsignedInteger('remaining_amount')->comment('剩余量');
            $table->string('denomination')->comment('面额');
            $table->date('start_at')->comment('开始时间');
            $table->date('end_at')->comment('结束时间');
            $table->string('link')->comment('链接');
            $table->text('promote_link')->comment('推广链接');
            $table->timestamps();
        });

        \DB::statement("ALTER TABLE `coupons` comment '优惠券表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coupons');
    }
}
