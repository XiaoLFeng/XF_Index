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
        $result = DB::table('xf_blog_friends')
            ->orderBy('id')
            ->get()
            ->toArray();
        foreach ($result as $value) {
            $value->blog_rss_judge ? $value->blog_rss_judge = 1 : $value->blog_rss_judge = 0;
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
                    'created_at' => date('Y-m-d H:i:s'),
                ]);
        }
    }
}
