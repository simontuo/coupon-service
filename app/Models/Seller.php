<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    protected $fillable = [
        'seller_id', 'shop_name', 'wean_wang_name'
    ];

    public function goods()
    {
        return $this->hasMany(Goods::class);
    }
}
