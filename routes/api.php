<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::prefix('v1')->group(function () {

    Route::get('/goods', 'GoodsController@pageList')->name('goodsPageList');
    Route::get('/goods/carousel', 'GoodsController@carouselList')->name('goodsCarouselList');
    Route::post('/goods/import', 'GoodsController@import')->name('goodsImport');
});
