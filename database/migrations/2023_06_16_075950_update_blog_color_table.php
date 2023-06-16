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

class UpdateBlogColorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('blog_color', function (Blueprint $table) {
            DB::table('blog_color')->insert([
                'colorLightType' => 'text-gray-500',
                'colorDarkType' => 'dark:text-gray-800',
                'comment' => '灰色'
            ]);
            DB::table('blog_color')->insert([
                'colorLightType' => 'text-blue-500',
                'colorDarkType' => 'dark:text-blue-800',
                'comment' => '蓝色'
            ]);
            DB::table('blog_color')->insert([
                'colorLightType' => 'text-indigo-500',
                'colorDarkType' => 'dark:text-indigo-800',
                'comment' => '靛青色'
            ]);
            DB::table('blog_color')->insert([
                'colorLightType' => 'text-purple-500',
                'colorDarkType' => 'dark:text-purple-800',
                'comment' => '紫色'
            ]);
            DB::table('blog_color')->insert([
                'colorLightType' => 'text-pink-500',
                'colorDarkType' => 'dark:text-pink-800',
                'comment' => '粉色'
            ]);
            DB::table('blog_color')->insert([
                'colorLightType' => 'text-green-500',
                'colorDarkType' => 'dark:text-green-800',
                'comment' => '绿色'
            ]);
            DB::table('blog_color')->insert([
                'colorLightType' => 'text-yellow-500',
                'colorDarkType' => 'dark:text-yellow-800',
                'comment' => '蓝色'
            ]);
            DB::table('blog_color')->insert([
                'colorLightType' => 'text-red-500',
                'colorDarkType' => 'dark:text-red-800',
                'comment' => '红色'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('blog_color', function (Blueprint $table) {
            //
        });
    }
}
