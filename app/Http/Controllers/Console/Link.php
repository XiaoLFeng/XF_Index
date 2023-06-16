<?php
/*
 * Copyright © 2016 - 2023 筱锋xiao_lfeng. All Rights Reserved.
 * 开发开源遵循 MIT 许可，若需商用请联系开发者
 * https://www.x-lf.com/
 */

namespace App\Http\Controllers\Console;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Index;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class Link extends Controller
{
    protected array $data;

    public function __construct()
    {
        $data = new Index();
        $this->data = $data->data;
    }

    public function ViewEdit(Request $request, $userId): Application|Factory|View|RedirectResponse
    {
        // 查找友链
        $resultBlog = DB::table('blog_link')
            ->find($userId);
        $this->data['blog'] = [
            $resultBlog,
        ];
        $this->data['blogSort'] = DB::table('blog_sort')
            ->orderBy('sort')
            ->get()
            ->toArray();
        $this->data['blogColor'] = DB::table('blog_color')
            ->orderBy('id')
            ->get()
            ->toArray();
        // 没有查询到执行删除
        if ($this->data['blog'][0] == null) return Response::redirectTo(route('console.friends-link.list'));
        return view('console.friends-link.edit', $this->data);
    }

    protected function ViewList(Request $request): Factory|View|Application|RedirectResponse
    {
        $this->data['request'] = $request;
        $dataMarge = [
            'blogFriendsTotal' => DB::table('blog_link')
                ->whereNotIn('blog_link.blogLocation', [0])
                ->count(),
            'blogFriendsCheck' => DB::table('blog_link')
                ->where('blog_link.blogLocation', 0)
                ->count(),
            'blogFriendsBest' => DB::table('blog_link')
                ->where('blog_link.blogLocation', 2)
                ->count(),
        ];
        if (empty($request->search)) {
            // 获取数据库信息
            if (empty($request->page)) $request->page = 0;
            $this->data['blog'] = DB::table('blog_link')
                ->whereNotIn('blogLocation', [0])
                ->orderBy('id')
                ->offset($request->page * 10)
                ->limit(10)
                ->get()
                ->toArray();
            $this->data['blogCount'] = DB::table('blog_link')
                ->whereNotIn('blogLocation', [0])
                ->orderBy('id')
                ->count();
            $this->data['webClass'] = [
                'active' => 'px-3 py-2 text-blue-600 border border-gray-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white',
                'unactive' => 'px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white',
            ];
            $this->data['blogCount'] = ceil($this->data['blogCount'] / 10);
            if ($this->data['request']->page > $this->data['blogCount'] - 1) return Response::redirectTo(route('console.friends-link.list'));
        } else {
            $this->data['blog'] = DB::select("SELECT * FROM xf_index.blog_link WHERE blogName LIKE '%$request->search%' OR blogUrl LIKE '%$request->search%' ORDER BY id");
        }
        $this->data = array_merge($this->data, $dataMarge);
        return view('console.friends-link.list', $this->data);
    }

    protected function ViewCheck(Request $request): Factory|View|Application
    {
        return view('console.friends-link.check', $this->data);
    }

    protected function ViewAdd(Request $request): Factory|View|Application
    {
        return view('console.friends-link.add', $this->data);
    }

    protected function ViewSort(): Factory|View|Application
    {
        return view('console.friends-link.sort',$this->data);
    }

    protected function ViewColor(): Factory|View|Application
    {
        return view('concole.friends-link.color',$this->data);
    }
}
