<?php
/*
 * Copyright © 2016 - 2023 筱锋xiao_lfeng. All Rights Reserved.
 * 开发开源遵循 MIT 许可，若需商用请联系开发者
 * https://www.x-lf.com/
 */

namespace App\Http\Controllers\Function;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Index;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Link extends Controller
{
    protected array $data;

    public function __construct()
    {
        $data = new Index();
        $this->data = $data->data;
    }

    protected function ViewLink(Request $request): Factory|View|Application
    {
        $this->data['webSubTitle'] = '友链';
        $this->GetFriendsLink($this->data);
        return view('function.link',$this->data);
    }

    private function GetFriendsLink(array &$data): void
    {
        $data['blogLink'] = DB::table('blog_link')->whereNotIn('blog_link.blogLocation',[0])->get()->toArray();
        $data['blogSort'] = DB::table('blog_sort')->orderBy('blog_sort.sort')->get()->toArray();
    }
}
