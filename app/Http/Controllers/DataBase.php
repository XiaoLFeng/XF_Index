<?php
/*
 * Copyright © 2016 - 2023 筱锋xiao_lfeng. All Rights Reserved.
 * 开发开源遵循 MIT 许可，若需商用请联系开发者
 * https://www.x-lf.com/
 */

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class DataBase extends Controller
{

    public function __construct()
    {
        DB::statement("TRUNCATE TABLE `xf_index`.`blog_link`");
        $resultBlog = DB::table('xf_blog_friends')
            ->orderBy('id')
            ->get()
            ->toArray();
        foreach ($resultBlog as $value) {
            $value->blog_rss_judge ? $value->blog_rss_judge = 1 : $value->blog_rss_judge = 0;
            if ($value->blog_sel_color == 8) $value->blog_sel_color = 6;
            if ($value->blog_sel_color == 2) $value->blog_sel_color = 8;
            if ($value->blog_sel_color == 7) $value->blog_sel_color = 4;
            if ($value->blog_sel_color == 5) $value->blog_sel_color = 3;

            if (empty($value->blog_owner_email)) $value->blog_owner_email = null;
            if (empty($value->blog_rss)) $value->blog_rss = null;
            if (empty($value->blog_serverhost)) $value->blog_serverhost = null;
            DB::table('blog_link')
                ->insert([
                    'blogName' => $value->blog_name,
                    'blogUrl' => $value->blog_url,
                    'blogDescription' => $value->blog_introduce,
                    'blogOwnEmail' => $value->blog_owner_email,
                    'blogIcon' => $value->blog_icon,
                    'blogRssJudge' => $value->blog_rss_judge,
                    'blogRSS' => $value->blog_rss,
                    'blogServerHost' => $value->blog_serverhost,
                    'blogLocation' => $value->blog_location,
                    'blogSetColor' => $value->blog_sel_color,
                    'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'),
                ]);
        }

        DB::statement("TRUNCATE TABLE `xf_index`.`sponsor`");
        $resultSponsor = DB::table('xf_sponsor')
            ->orderBy('id')
            ->get()
            ->toArray();
        foreach ($resultSponsor as $value) {
            if ($value->mode == 'AliPay') $value->mode = 1;
            if ($value->mode == 'WeChat') $value->mode = 2;
            if ($value->mode == 'QQ') $value->mode = 3;
            if ($value->mode == 'PayPal') $value->mode = 4;
            if (empty($value->url)) $value->url = null;
            DB::table('sponsor')
                ->insert([
                    'name' => $value->name,
                    'url' => $value->url,
                    'type' => $value->mode,
                    'money' => $value->count,
                    'time' => $value->time,
                ]);
        }

        DB::statement("TRUNCATE TABLE `xf_index`.`sponsor_type`");
        DB::table('sponsor_type')
            ->insert([
                [
                    'name' => '支付宝',
                    'url' => 'https://i-cdn.akass.cn/2023/07/64ba859272bc9.jpg',
                    'include' => 1,
                    'link' => 0,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')],
                [
                    'name' => '微信',
                    'url' => 'https://i-cdn.akass.cn/2023/07/64ba67c9d08ab.jpg',
                    'include' => 1,
                    'link' => 0,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')],
                [
                    'name' => '扣扣',
                    'url' => 'https://i-cdn.akass.cn/2023/07/64ba8817b179b.png',
                    'include' => 1,
                    'link' => 0,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')],
                [
                    'name' => 'PayPal',
                    'url' => 'https://www.paypal.com/paypalme/xiaolfeng',
                    'include' => 1,
                    'link' => 1,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')],
                [
                    'name' => '爱发电',
                    'url' => 'https://afdian.net/a/xiao_lfeng',
                    'include' => 1,
                    'link' => 1,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')],
            ]);
    }
}
