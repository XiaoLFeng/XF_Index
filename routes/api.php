<?php
/*
 * Copyright © 2016 - 2023 筱锋xiao_lfeng. All Rights Reserved.
 * 开发开源遵循 MIT 许可，若需商用请联系开发者
 * https://www.x-lf.com/
 */

use App\Http\Controllers\Authme;
use App\Http\Controllers\Function\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
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

Route::middleware('auth')->get('/user', function (Request $request) {
    return $request->user();
});

// 登陆类
Route::prefix('auth')->group(function () {
    Route::post('login',[Authme::class,'Login'])->name('api.auth.login');
    Route::post('register',[Authme::class,'Register'])->name('api.auth.register');
    Route::match(['get','post'],'logout',function () {
        Auth::logout();
        return Response::redirectTo('');
    })->name('logout');
});

// 友链类
Route::prefix('link')->group(function () {
    Route::prefix('console')->group(function () {

    });
    Route::prefix('custom')->group(function () {
        Route::post('add',[Link::class,'apiCustomAdd'])->name('api.link.custom.add');
        Route::get('search',[Link::class, 'apiCustomSearch'])->name('api.link.custom.search');
        Route::post('blogCheck',[Link::class,'apiCustomBlogCheck'])->name('api.link.custom.blogCheck');
    });
});
