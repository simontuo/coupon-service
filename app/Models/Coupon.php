<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = [
        'goods_id',
        'coupon_id',
        'total_amount',
        'remaining_amount',
        'denomination',
        'start_at',
        'end_at',
        'link',
        'promote_link',
    ];

    protected  $appends = [
        'price'
    ];

    public function goods()
    {
        return $this->belongsTo(Goods::class);
    }

    public function getPriceAttribute() :int
    {

        return (int) head(explode('元', last(explode('减', $this->denomination))));
    }
}
