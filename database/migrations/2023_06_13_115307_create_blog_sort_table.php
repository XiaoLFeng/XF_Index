<?php
/*
 * Copyright © 2016 - 2023 筱锋xiao_lfeng. All Rights Reserved.
 * 开发开源遵循 MIT 许可，若需商用请联系开发者
 * https://www.x-lf.com/
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogSortTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_sort', function (Blueprint $table) {
            $table->id();
            $table->integer('sort')->comment('排序（数字越小权限越大）');
            $table->string('title')->comment('标题');
            $table->text('description')->comment('描述')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blog_sort');
    }
}
