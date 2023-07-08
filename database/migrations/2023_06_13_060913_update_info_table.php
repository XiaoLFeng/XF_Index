<?php
/*
 * Copyright © 2016 - 2023 筱锋xiao_lfeng. All Rights Reserved.
 * 开发开源遵循 MIT 许可，若需商用请联系开发者
 * https://www.x-lf.com/
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class UpdateInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('info', function (Blueprint $table) {
            // 构建数据
            DB::table('info')->insert(['value' => 'title', 'created_at' => date('Y-m-d H:i:s')]);
            DB::table('info')->insert(['value' => 'description', 'created_at' => date('Y-m-d H:i:s')]);
            DB::table('info')->insert(['value' => 'subTitle', 'created_at' => date('Y-m-d H:i:s')]);
            DB::table('info')->insert(['value' => 'subTitleDescription', 'created_at' => date('Y-m-d H:i:s')]);
            DB::table('info')->insert(['value' => 'icon', 'created_at' => date('Y-m-d H:i:s')]);
            DB::table('info')->insert(['value' => 'keyword', 'created_at' => date('Y-m-d H:i:s')]);
            DB::table('info')->insert(['value' => 'webHeader', 'created_at' => date('Y-m-d H:i:s')]);
            DB::table('info')->insert(['value' => 'webFooter', 'created_at' => date('Y-m-d H:i:s')]);
            DB::table('info')->insert(['value' => 'aboutMe', 'created_at' => date('Y-m-d H:i:s')]);
            DB::table('info')->insert(['value' => 'icp', 'created_at' => date('Y-m-d H:i:s')]);
            DB::table('info')->insert(['value' => 'gongan', 'created_at' => date('Y-m-d H:i:s')]);
            DB::table('info')->insert(['value' => 'author', 'created_at' => date('Y-m-d H:i:s')]);
            DB::table('info')->insert(['value' => 'copyRightYear', 'created_at' => date('Y-m-d H:i:s')]);
            DB::table('info')->insert(['value' => 'blog', 'created_at' => date('Y-m-d H:i:s')]);
            DB::table('info')->insert(['value' => 'applicationRule', 'created_at' => date('Y-m-d H:i:s')]);
            DB::table('info')->insert(['value' => 'applicationInfo', 'created_at' => date('Y-m-d H:i:s')]);
            DB::table('info')->insert(['value' => 'email', 'created_at' => date('Y-m-d H:i:s')]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('info', function (Blueprint $table) {
            //
        });
    }
}
