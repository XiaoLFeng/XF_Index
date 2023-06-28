<?php
/*
 * Copyright © 2016 - 2023 筱锋xiao_lfeng. All Rights Reserved.
 * 开发开源遵循 MIT 许可，若需商用请联系开发者
 * https://www.x-lf.com/
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('code', function (Blueprint $table) {
            $table->id()
                ->comment('自动ID');
            $table->string('email',100)
                ->comment('邮箱');
            $table->string('code',64)
                ->comment('验证码内容');
            $table->string('type',40)
                ->comment('类型（例如：CODE-CUSTOM-CHECK）');
            $table->integer('sendTime')
                ->comment('发送时间');
            $table->integer('time')
                ->comment('存储结束时间戳');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('code');
    }
}
