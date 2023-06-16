<?php
/*
 * Copyright © 2016 - 2023 筱锋xiao_lfeng. All Rights Reserved.
 * 开发开源遵循 MIT 许可，若需商用请联系开发者
 * https://www.x-lf.com/
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogColorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_color', function (Blueprint $table) {
            $table->id();
            $table->boolean('onlyAdminUse')->default(0)->comment('只允许管理员使用');
            $table->string('colorLightType')->default('text-gray-500')->comment('颜色ID');
            $table->string('colorDarkType')->default('dark:text-gray-800')->comment('暗色颜色ID');
            $table->string('comment')->nullable()->comment('备注');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blog_color');
    }
}
