<?php
/*
 * Copyright © 2016 - 2023 筱锋xiao_lfeng. All Rights Reserved.
 * 开发开源遵循 MIT 许可，若需商用请联系开发者
 * https://www.x-lf.com/
 */

class Key
{
    /**
     * 生成验证码
     * 说明：
     *
     * 1. [type(string)]
     *     - [Number] 数字验证码
     *     - [English]英文验证码
     *     - [Normal] 混合验证码
     * @param int $long 验证码长度
     * @param string $type 验证码类型
     * @return string 返回结果为生成的验证码
     */
    public static function Captcha(int $long, string $type = 'Number'): string
    {
        /** @var string $output */
        for ($i = 1; $i <= $long; $i++) {
            if ($type == 'Number') {
                $output = $output . rand(0, 9);
            } elseif ($type == 'English') {
                $output = $output . chr(rand(65, 90));
            } elseif ($type == 'Normal') {
                if (time() % 2 == 0) {
                    if ($i % 2 == 0) {
                        $output = $output . chr(rand(65, 90));
                    } else {
                        $output = $output . rand(0, 9);
                    }
                } else {
                    if ($i % 3 != 0) {
                        $output = $output . chr(rand(65, 90));
                    } else {
                        $output = $output . rand(0, 9);
                    }
                }
            }
        }
        return $output;
    }
}