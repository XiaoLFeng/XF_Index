<?php
/*
 * Copyright © 2016 - 2023 筱锋xiao_lfeng. All Rights Reserved.
 * 开发开源遵循 MIT 许可，若需商用请联系开发者
 * https://www.x-lf.com/
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogLinkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_link', function (Blueprint $table) {
            $table->id();
            $table->string('blogName',40);
            $table->string('blogUrl');
            $table->string('blogDescription');
            $table->string('blogOwnEmail',100)->nullable();
            $table->text('blogIcon');
            $table->boolean('blogRssJudge')->default(0);
            $table->text('blogRSS')->nullable();
            $table->string('blogServerHost')->nullable();
            $table->boolean('blogAdvJudge')->default(0);
            $table->boolean('blogSecurityJudge')->default(1);
            $table->unsignedInteger('blogLocation')->default(0);
            $table->unsignedInteger('blogSetColor')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blog_link');
    }
}
