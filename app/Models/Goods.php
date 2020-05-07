<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    protected $fillable = [
        'seller_id',
        'goods_id',
        'name',
        'image' ,
        'profile_url',
        'level_1_category',
        'tao_bao_guest_link',
        'price',
        'monthly_sales',
        'income_ratio',
        'commission',
        'platform_type',
    ];

    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }

    public function coupon()
    {
        return $this->hasOne(Coupon::class);
    }
}
