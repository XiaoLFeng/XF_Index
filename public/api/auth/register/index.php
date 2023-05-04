<?php
/*
 * Copyright © 2016 - 2023 筱锋xiao_lfeng. All Rights Reserved.
 * 开发开源遵循 MIT 许可，若需商用请联系开发者
 * https://www.x-lf.com/
 */

/**
 * @var Array $Json_Data 最终数据编译输出
 * @var array $Array_ConfigData 配置文件
 */

session_start();
// 引入配置
include dirname(__FILE__, 5) . "/Modules/API/header.php";
require dirname(__FILE__, 5) . "/class/Sql.php";
require dirname(__FILE__, 5) . "/class/Token.php";
require dirname(__FILE__, 5) . "/class/Mailer/SendMail.php";
require dirname(__FILE__, 5) . "/class/Normal.php";
require dirname(__FILE__, 5) . "/class/Key.php";

// 类配置
$ClassToken = new Token(40);
$ClassMailer = new Mailer\SendMail();

// 数据获取类型
$PostData = file_get_contents('php://input');
$PostData = json_decode($PostData, true);

// 函数构建
if ($Array_ConfigData['Session'] == $_SERVER['HTTP_SESSION']) {
    if (empty($_COOKIE['user'])) {
        // 检查数据
        if (preg_match('/^[0-9A-Za-z_]+$/', $PostData['username'])) {
            if (preg_match('/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/', $PostData['email'])) {
                // 密码加密
                $PostData['password'] = password_hash($PostData['password'], PASSWORD_DEFAULT);
                // 进行数据查找
                $AResult_User = Sql::SELECT("SELECT * FROM `index`.xf_user WHERE `username`='{$PostData['username']}' OR `email`='{$PostData['email']}'");
                if ($AResult_User['output'] == "EmptyResult") {
                    // 创建用户
                    if (Sql::INSERT("INSERT INTO `index`.xf_user (`username`,`email`,`password`,`reg_time`,`reg_ip`) VALUES ('{$PostData['username']}','{$PostData['email']}','{$PostData['password']}','" . time() . "','" . $_SERVER['REMOTE_ADDR'] . "')")) {
                        // 生成激活码
                        $Data_Captcha = Key::Captcha(50);
                        $Data_NowTime = time();
                        // 查找是否需要重新生成激活码
                        $AResult_UserData = Sql::SELECT("SELECT * FROM `index`.xf_user WHERE `username`='{$PostData['username']}' OR `email`='{$PostData['email']}'");
                        if ($AResult_UserData['output'] == "Success") {
                            $AResult_UserEmailVerify = Sql::SELECT("SELECT * FROM `index`.xf_email_verify WHERE `uid`='{$AResult_UserData['data'][0]->uid}' AND `time` >= " . ($Data_NowTime - $Array_ConfigData['Mail']['ExpDate']));
                            if ($AResult_UserEmailVerify['output'] == "EmptyResult") {
                                // 创建激活码
                                if (Sql::INSERT("INSERT INTO `index`.xf_email_verify (`uid`, `code`, `time`) VALUES ('{$AResult_UserData['data'][0]->uid}','$Data_Captcha','$Data_NowTime')")) {
                                    // 邮件发送
                                    if ($ClassMailer->PostMail($PostData['email'], 1, $Data_Captcha))
                                        Normal::Output(200);
                                    else Normal::Output(201);
                                } else Normal::Output(300);
                            } else Normal::Output(500);
                        } else Normal::Output(301);
                    } else Normal::Output(300);
                } else Normal::Output(600);
            } else Normal::Output(401);
        } else Normal::Output(400);
    } else {
        // 数据库查找用户是否存在
        $AResult_User = Sql::SELECT("SELECT * FROM `index`.xf_user WHERE `uid`='{$_COOKIE['user']}'");
        if ($AResult_User['output'] == 'Success') {
            $Json_Data = [
                'output' => "AlReadyLogin",
                'code' => 403,
                'data' => [
                    'message' => "您已登录",
                ],
            ];
        } else if ($AResult_User['output'] == 'EmptyResult') {
            $Json_Data = [
                'output' => "IllegalLogin",
                'code' => 403,
                'data' => [
                    'message' => "非法登录",
                ],
            ];
        } else {
            $Json_Data = [
                'output' => $AResult_User['output'],
                'code' => 403,
                'data' => [
                    'message' => "数据库搜索类型错误",
                ],
            ];
        }
        echo json_encode($Json_Data, JSON_UNESCAPED_UNICODE);
    }
} else {
    Normal::Output(100);
}
End: