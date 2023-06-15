<?php
/*
 * Copyright © 2016 - 2023 筱锋xiao_lfeng. All Rights Reserved.
 * 开发开源遵循 MIT 许可，若需商用请联系开发者
 * https://www.x-lf.com/
 */

use App\Http\Controllers\Console\Dashboard;
use App\Http\Controllers\Function\Link;
use App\Http\Controllers\Index;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [Index::class,'ViewIndex'])->name('home');
Route::get('about',[Index::class,'ViewAboutMe'])->name('about');

Route::prefix('function')->group(function () {
    Route::get('link',[Link::class,'ViewLink'])->name('function.link');
    Route::get('make-friend',[Link::class,'ViewMakeFriend'])->name('function.make-friend');
    Route::get('sponsor',function () {
        return view('function.sponsor');
    })->name('function.sponsor');
    Route::get('music',function () {
        return view('function.music');
    })->name('function.music');
});

Route::prefix('console')->middleware('auth')->group(function () {
    Route::get('dashboard', [Dashboard::class,'ViewDashboard'])->name('console.dashboard');
});

Route::prefix('auth')->group(function () {
    Route::redirect('','auth/login');
    Route::get('login', function () {
        $data = (new Index())->data;
        return view('auth.login',$data);
    })->name('login');
    Route::get('register',function () {
        $data = (new Index())->data;
        return view('auth.register',$data);
    })->name('register');
    Route::get('forgotpassword',function () {
        $data = (new Index())->data;
        return view('auth.forgotpassword',$data);
    })->name('forgotpassword');
    Route::match(['get','post'],'logout',function () {
        Auth::logout();
        return Response::redirectTo('');
    })->name('logout');
});
