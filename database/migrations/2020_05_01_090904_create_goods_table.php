<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('seller_id')->comment('卖家id');
            $table->string('goods_id', 50)->comment('商品id');
            $table->string('name')->comment('名称');
            $table->string('image')->comment('主图');
            $table->string('profile_url')->comment('详情页链接地址');
            $table->string('level_1_category')->comment('一级类目');
            $table->text('tao_bao_guest_link')->comment('淘宝客链接');
            $table->decimal('price', 10, 2)->comment('价格');
            $table->unsignedInteger('monthly_sales')->comment('月销量');
            $table->double('income_ratio', 10, 2)->comment('收入比率');
            $table->decimal('commission', 10, 2)->comment('佣金');
            $table->string('platform_type', 50)->comment('平台类型');
            $table->timestamps();
        });

        \DB::statement("ALTER TABLE `goods` comment '商品表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('goods');
    }
}
