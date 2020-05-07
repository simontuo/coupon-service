<?php

namespace App\Imports;

use App\Models\Coupon;
use App\Models\Goods;
use App\Models\Seller;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class GoodsImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        unset($collection[0]);

        $collection->unique(0)->map(function($item) {
            $seller = $this->createSeller($item);
            $goods = $this->createGoods($seller, $item);
            $this->createCoupon($goods, $item);
        });
    }

    public function createSeller($item)
    {
        $seller = Seller::updateOrCreate(
            ['seller_id' => $item[11]],
            [
                'shop_name' => $item[12],
                'wean_wang_name' => $item[10]
            ]
        );

        return $seller;
    }

    public function createGoods(Seller $seller, $item)
    {
        $goods = Goods::updateOrCreate(
            ['goods_id' => $item[0]],
            [
                'seller_id' => $seller->id,
                'name' => $item[1],
                'image' => $item[2],
                'profile_url' => $item[3],
                'level_1_category' => $item[4],
                'tao_bao_guest_link' => $item[5],
                'price' => $item[6],
                'monthly_sales' => $item[7],
                'income_ratio' => $item[8],
                'commission' => $item[9],
                'platform_type' => $item[13],
            ]
        );

        return $goods;
    }

    public function createCoupon(Goods $goods, $item)
    {
         Coupon::updateOrCreate(
            ['goods_id' => $goods->id],
            [
                'coupon_id' => $item[14],
                'total_amount' => $item[15],
                'remaining_amount' => $item[16],
                'denomination' => $item[17],
                'start_at' => $item[18],
                'end_at' => $item[19],
                'link' => $item[20],
                'promote_link' => $item[21],
            ]
        );
    }
}
