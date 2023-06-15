<?php
/*
 * Copyright © 2016 - 2023 筱锋xiao_lfeng. All Rights Reserved.
 * 开发开源遵循 MIT 许可，若需商用请联系开发者
 * https://www.x-lf.com/
 */

namespace App\Http\Controllers;

use App\Http\Middleware\Michelf\MarkdownExtra;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Index extends Controller
{
    public array $data;

    public function __construct()
    {
        $this->data = [
            'webTitle' => empty($tempStorage = DB::table('info')->find(1)->data) ? '未定义标题' : $tempStorage,
            'webDescription' => empty($tempStorage = DB::table('info')->find(2)->data) ? '未定义副标题' : $tempStorage,
            'webSubTitle' => empty($tempStorage = DB::table('info')->find(3)->data) ? '未定义小标题' : $tempStorage,
            'webSubTitleDescription' => empty($tempStorage = DB::table('info')->find(4)->data) ? '未定义小标题内容' : $tempStorage,
            'webIcon' => empty($tempStorage = DB::table('info')->find(5)->data) ? asset('images/logo.jpg') : $tempStorage,
            'webHeader' => DB::table('info')->find(7)->data,
            'webFooter' => DB::table('info')->find(8)->data,
            'webKeyword' => empty($tempStorage = DB::table('info')->find(6)->data) ? '筱锋,凌中的锋雨,xiao_lfeng' : $tempStorage,
            'sqlAuthor' => empty($tempStorage = DB::table('info')->find(12)->data) ? '筱锋xiao_lfeng' : $tempStorage,
            'sqlCopyRightYear' => DB::table('info')->find(13)->data,
            'sqlIcp' => DB::table('info')->find(10)->data,
            'sqlGongan' => DB::table('info')->find(11)->data,
            'sqlBlog' => DB::table('info')->find(14)->data,
        ];
        if (!empty($this->data['sqlGongan'])) {
            preg_match('/[0-9]+/', $this->data['sqlGongan'], $data);
            $this->data = array_merge($this->data, ['GonganCode' => $data[0]]);
        }
        if (Auth::check()) {
            $this->data = array_merge($this->data,[
                'userName' => Auth::user()->username,
                'userEmail' => Auth::user()->email,
                'userIcon' => Auth::user()->icon]);
        }
    }

    protected function ViewIndex(): Factory|View|Application
    {
        return view('index', $this->data);
    }

    protected function ViewAboutMe(): Factory|View|Application
    {
        $resultAboutMe = DB::table('info')->where('info.value', '=', 'aboutMe')->value('info.data');
        $data = [
            'userAbout' => $this->MarkdownToStringReplace($resultAboutMe),
        ];
        $this->data = array_merge($this->data, $data);
        return view('about', $this->data);
    }

    private function MarkdownToStringReplace(string $dataBase): string
    {
        $decodeText = MarkdownExtra::defaultTransform($dataBase);
        $decodeText = str_replace('<h1>', '<p class="text-4xl font-extrabold text-gray-900 dark:text-white mb-4"><i class="bi bi-link-45deg"></i>', $decodeText);
        $decodeText = str_replace('<h2>', '<p class="text-3xl font-extrabold text-gray-900 dark:text-white mb-4"><i class="bi bi-link-45deg"></i>', $decodeText);
        $decodeText = str_replace('<h3>', '<p class="text-2xl font-bold text-gray-900 dark:text-white mb-4"><i class="bi bi-link-45deg"></i>', $decodeText);
        $decodeText = str_replace('<h4>', '<p class="text-xl font-bold text-gray-900 dark:text-white mb-4"><i class="bi bi-link-45deg"></i>', $decodeText);
        $decodeText = str_replace('<h5>', '<p class="text-lg font-semibold text-gray-900 dark:text-white mb-4"><i class="bi bi-link-45deg"></i>', $decodeText);
        $decodeText = str_replace('<h6>', '<p class="text-base font-medium text-gray-900 dark:text-white mb-4"><i class="bi bi-link-45deg"></i>', $decodeText);
        $decodeText = str_replace('<p>', '<p class="text-base text-gray-900 dark:text-white m-4">', $decodeText);
        $decodeText = str_replace('<a', '<a class="text-base text-gray-900 dark:text-white m-4"', $decodeText);
        $decodeText = str_replace('<img', '<img class="rounded-lg mb-4"', $decodeText);
        $decodeText = str_replace('<hr>', '<hr class="my-4">', $decodeText);
        return (string)$decodeText;
    }
}
