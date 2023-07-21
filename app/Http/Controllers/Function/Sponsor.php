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

class Sponsor extends Controller
{
    private array $data;

    public function __construct()
    {
        $data = new Index();
        $this->data = $data->data;
    }

    protected function viewSponsor(): Factory|View|Application
    {
        return view('function.sponsor', $this->data);
    }
}
