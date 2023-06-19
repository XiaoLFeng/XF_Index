<?php
/*
 * Copyright © 2016 - 2023 筱锋xiao_lfeng. All Rights Reserved.
 * 开发开源遵循 MIT 许可，若需商用请联系开发者
 * https://www.x-lf.com/
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateBlogLinkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('blog_link', function (Blueprint $table) {
            $table->boolean('blogAddType')->default(0)->after('blogLocation');
            $table->unsignedInteger('blogUserLocation')
                ->default(0)
                ->after('blogSetColor')
                ->comment('用户期望位置');
            $table->unsignedBigInteger('blogForUser')
                ->nullable()
                ->after('blogUserLocation')
                ->comment('绑定已注册用户');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('blog_link', function (Blueprint $table) {
            //
        });
    }
}
