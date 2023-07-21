<?php
/*
 * Copyright © 2016 - 2023 筱锋xiao_lfeng. All Rights Reserved.
 * 开发开源遵循 MIT 许可，若需商用请联系开发者
 * https://www.x-lf.com/
 */

use App\Http\Controllers\Authme;
use App\Http\Controllers\Console\Link as ConsoleLink;
use App\Http\Controllers\Function\Link;
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
        Route::post('add', [ConsoleLink::class, 'apiConsoleAdd'])->name('api.link.console.add');
        Route::post('edit', [ConsoleLink::class, 'apiConsoleEdit'])->name('api.link.console.edit');
        Route::post('check', [ConsoleLink::class, 'apiConsoleCheck'])->name('api.link.console.check');
        Route::post('check-fail', [ConsoleLink::class, 'apiConsoleCheckFail'])->name('api.link.console.check-fail');
        Route::post('delete', [ConsoleLink::class, 'apiConsoleDelete'])->name('api.link.console.delete');
    });
    Route::prefix('custom')->group(function () {
        Route::post('add', [Link::class, 'apiCustomAdd'])->name('api.link.custom.add');
        Route::post('edit/{friendId}', [Link::class, 'apiCustomEdit'])->name('api.link.custom.edit');
        Route::get('search', [Link::class, 'apiCustomSearch'])->name('api.link.custom.search');
        Route::post('blogCheck',[Link::class,'apiCustomBlogCheck'])->name('api.link.custom.blogCheck');
        Route::post('blogVerify',[Link::class,'apiCustomBlogVerify'])->name('api.link.custom.blogVerify');
    });
});
