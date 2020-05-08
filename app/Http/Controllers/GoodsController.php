<?php

namespace App\Http\Controllers;

use App\Imports\GoodsImport;
use App\Models\Goods;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class GoodsController extends Controller
{
    public function __construct()
    {

    }

    public function pageList(Request $request)
    {

        $sql   = $this->buildQuery('Goods', $request->get('query'))
            ->with(['seller', 'coupon']);
        $items = $sql->paginate($request->pageSize);
        $items->map(function ($item) {
            $item->coupon_after_price = $this->getCouponAfterPrice($item);
            return $item;
        });

        return response()->json([
            'code' => 20000,
            'data' => $items
        ], 200);
    }

    public function buildQuery($model, $query)
    {
        $query = json_decode($query);
        $sql   = app('App\Models\\' . $model)
            ->when(isset($query->key) && $query->key, function ($sql) use ($query) {
                $sql->where('name', 'like', "%" . $query->key . '%');
            })
            ->when(isset($query->level_1_category) && $query->key, function ($sql) use ($query) {
                $sql->where('level_1_category', 'like', "%" . $query->level_1_category . '%');
            });

        if (isset($query->order_by) && $query->order_by) {
            switch ($query->order_by) {
                case 'coupons_price':
                    // $sql = $sql->orderBy('coupons.price', 'desc');
                    break;
                case 'monthly_sales':
                    $sql = $sql->orderBy($query->order_by, 'desc');
                    break;
                case 'price':
                    $sql = $sql->orderBy($query->order_by);
                    break;
                default:
                    abort(500, '不存在的排序类型');
                    break;
            }
        }

        return $sql;
    }

    function getCouponAfterPrice($item)
    {
        return number_format(round($item->price - $item->coupon->price, 2), 2);
    }

    public function carouselList(Request $request)
    {
        $items = Goods::with(['seller', 'coupon'])->orderBy('monthly_sales', 'desc')->limit(6)->get();

        return response()->json([
            'code' => 20000,
            'data' => $items
        ], 200);
    }

    public function import(Request $request)
    {
        Excel::import(new GoodsImport(), $request->file);

        return response()->json([
            'code'    => 200,
            'message' => '导入成功'
        ], 200);
    }
}
