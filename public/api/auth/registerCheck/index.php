<?php
/*
 * Copyright © 2016 - 2023 筱锋xiao_lfeng. All Rights Reserved.
 * 开发开源遵循 MIT 许可，若需商用请联系开发者
 * https://www.x-lf.com/
 */

/**
 * 此页面为注册验证页面
 * 当用户执行注册后（register 模块）执行完毕之后，会给用户发送邮件激活，相对应的激活码会发送至指定邮箱，用户需要根据邮箱内容进入此位置进行激活操作
 * <p>
 * 激活码为 50 位固定字符，其合法性规定按照下列正则表达式确定
 *
 * @author 筱锋xiao_lfeng
 * @since v1.0.0-Alpha
 * @var array $Json_Data 最终数据编译输出
 * @var array $Array_ConfigData 配置文件
 */

// 引入配置
include dirname(__FILE__, 5) . "/Modules/API/header.php";
require dirname(__FILE__, 5) . "/class/Sql.php";
require dirname(__FILE__, 5) . "/class/Normal.php";

// 数据获取类型
$GetData = [
    'code' => urldecode(htmlspecialchars($_GET['code'])),
];

// 函数构建
if ($Array_ConfigData['Session'] == $_SERVER['HTTP_SESSION']) { /* 检查通讯密钥是否正确 */
    // check user login
    if (!empty($_COOKIE['user'])) {
        // check user cookie for user
        if (preg_match("/^[0-9]+$/", $_COOKIE['user'])) {
            // check the user code is true
            if (!empty($GetData['code'])) {
                // check user verify code have right input
                if (preg_match("/^[0-9A-Za-z]{50}/", $GetData['code'])) {
                    // put user verify code into sql to select
                    $AResult_Code = Sql::SELECT("SELECT * FROM `index`.`xf_email_verify` WHERE `code`='{$GetData['code']}'");
                    // check sql data not empty
                    if ($AResult_Code['output'] = "Success") {
                        // check this verify code have effective
                        if ($AResult_Code['data']->time + $Array_ConfigData['Mail']['ExpDate'] > time()) {
                            if ($_COOKIE['user'] == $AResult_Code['data']->uid) {
                                // update this user info in sql (update xf_user.email_verify)
                                if (Sql::UPDATE("UPDATE `index`.xf_user SET `email_verify`=1 WHERE `uid`='{$_COOKIE['user']}'")) {
                                    // delete the email_verify
                                    if (Sql::DELETE("DELETE FROM `index`.xf_email_verify WHERE `id`='{$AResult_Code['data']->id}'")) {
                                        Normal::Output(200);
                                    } else {
                                        Normal::Output(303);
                                    }
                                } else {
                                    Normal::Output(302);
                                }
                            } else {
                                Normal::CustomOutput("codeNotYour", 403, "这个验证码不是你");
                            }
                        } else {
                            Sql::DELETE("DELETE FROM `index`.xf_email_verify WHERE `id`='{$AResult_Code['data']->id}'");
                            Normal::CustomOutput("codeIsDisEffective", 403, "验证码已过期");
                        }
                    } else {
                        // SqlSelectFail__CodeEmpty
                        Normal::Output(301, null, "codeEmpty");
                    }
                } else {
                    Normal::CustomOutput("codeFormat", 403, "激活码格式错误");
                }
            } else {
                Normal::CustomOutput("noCode", 403, "请提供激活码");
            }
        } else {
            // userFormat
            Normal::Output(402);
        }
    } else {
        Normal::CustomOutput("NoLogin", 502, "需要登录");
    }
} else {
    // 编译输出
    Normal::Output(100);
}