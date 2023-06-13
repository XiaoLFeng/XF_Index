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

class Index extends Controller
{
    public array $data;

    public function __construct()
    {
        if (Auth::check()) {
            $this->data = [
                'userName' => Auth::user()->username,
                'userEmail' => Auth::user()->email,
                'userIcon' => Auth::user()->icon,
            ];
        } else {
            $this->data = array();
        }
    }

    protected function ViewIndex(): Factory|View|Application
    {
        return view('index',$this->data);
    }
}
