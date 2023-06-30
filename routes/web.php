<?php
/*
 * Copyright © 2016 - 2023 筱锋xiao_lfeng. All Rights Reserved.
 * 开发开源遵循 MIT 许可，若需商用请联系开发者
 * https://www.x-lf.com/
 */

use App\Http\Controllers\Console\Dashboard;
use App\Http\Controllers\Console\Link as ConsoleLink;
use App\Http\Controllers\Function\Link as UserLink;
use App\Http\Controllers\Index;
use Illuminate\Http\Request;
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
    Route::get('link',[UserLink::class, 'viewLink'])->name('function.link');
    Route::get('make-friend',[UserLink::class, 'viewMakeFriend'])->name('function.make-friend');
    Route::get  ('edit-search',[UserLink::class, 'viewSearchFriends'])->name('function.edit-search');
    Route::get('edit-search/{friendId}',[UserLink::class,'viewSearchFriend'])->name('function.edit-searchOnly');
    Route::get('edit-friend/{friendId}',function ($friendId) {
        $userLink = new UserLink();
        return $userLink->viewEditFriend($friendId);
    })->name('function.edit-friend');
    Route::get('sponsor',function () {
        return view('function.sponsor');
    })->name('function.sponsor');
    Route::get('music',function () {
        return view('function.music');
    })->name('function.music');
});

Route::prefix('account')->middleware('auth')->group(function () {
    Route::prefix('friend')->group(function () {
        Route::get('link')->name('account.friend.link');
        Route::get('edit')->name('account.friend.edit');
    });
});

Route::prefix('console')->middleware('auth')->group(function () {
    Route::get('dashboard', [Dashboard::class,'ViewDashboard'])->name('console.dashboard');
    Route::prefix('friends-link')->group(function () {
        Route::redirect('list','list/1');
        Route::get('list',[ConsoleLink::class,'ViewList'])->name('console.friends-link.list');
        Route::get('check',[ConsoleLink::class,'ViewCheck'])->name('console.friends-link.check');
        Route::get('edit/{userId}',function ($userId) {
            $ConsoleLink = new ConsoleLink();
            $request = new Request();
            return $ConsoleLink->ViewEdit($request,$userId);
        })->name('console.friends-link.edit');
        Route::get('add',[ConsoleLink::class,'ViewAdd'])->name('console.friends-link.add');
        Route::get('sort',[ConsoleLink::class,'ViewSort'])->name('console.friends-link.sort');
        Route::get('color',[ConsoleLink::class,'ViewColor'])->name('console.friends-link.color');
    });
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
