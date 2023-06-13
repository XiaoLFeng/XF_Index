<?php
/*
 * Copyright © 2016 - 2023 筱锋xiao_lfeng. All Rights Reserved.
 * 开发开源遵循 MIT 许可，若需商用请联系开发者
 * https://www.x-lf.com/
 */

use App\Http\Controllers\Console\Dashboard;
use App\Http\Controllers\Console\Index;
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

Route::prefix('console')->middleware('auth')->group(function () {
    Route::get('dashboard', [Dashboard::class,'ViewDashboard'])->name('console.dashboard');
});

Route::prefix('auth')->group(function () {
    Route::redirect('','auth/login');
    Route::get('login', function () {
        return view('auth.login');
    })->name('login');
    Route::get('register',function () {
        return view('auth.register');
    })->name('register');
    Route::get('forgotpassword',function () {
        return view('auth.forgotpassword');
    })->name('forgotpassword');
    Route::match(['get','post'],'logout',function () {
        Auth::logout();
        return Response::redirectTo('');
    })->name('logout');
});
