<?php
/*
 * Copyright © 2016 - 2023 筱锋xiao_lfeng. All Rights Reserved.
 * 开发开源遵循 MIT 许可，若需商用请联系开发者
 * https://www.x-lf.com/
 */

namespace App\Http\Controllers\Console;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Dashboard extends Controller
{
    protected array $data;

    public function __construct()
    {
        $this->data = [
            'userName' => Auth::user()->username,
            'userEmail' => Auth::user()->email,
            'userLinkId' => Auth::user()->linkId,
        ];
    }

    protected function ViewDashboard(): Factory|View|Application
    {
        $dataMarge = [
            'blogFriendsTotal' => DB::table('blog_link')->whereNotIn('blog_link.blogLocation', [0,7])->count(),
            'blogFriendsCheck' => DB::table('blog_link')->where('blog_link.blogLocation', 0)->count(),
            'blogFriendsBest' => DB::table('blog_link')->where('blog_link.blogLocation',2)->count(),
        ];
        $this->data = array_merge($this->data,$dataMarge);
        return view('console.dashboard',$this->data);
    }
}
