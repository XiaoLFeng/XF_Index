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

use Mailer\SendMail;

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
$ClassMailer = new SendMail();

// 数据获取类型
$PostData = file_get_contents('php://input');
$PostData = json_decode($PostData, true);

// 逻辑构建
if ($Array_ConfigData['Session'] == $_SESSION['HTTP_SESSION']) {
    // 检查用户提交数据
    if (preg_match('/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/', $PostData['user']) || preg_match('/^[0-9A-Za-z_]]/', $PostData['user'])) {
        // 数据库查找用户
        $AResult_User = Sql::SELECT("SELECT * FROM `index`.xf_user WHERE `username`='{$PostData['user']}' OR `email`='{$PostData['user']}'");
        if ($AResult_User == 'Success') {
            // 判断密码是否正确
            if (password_verify($PostData['password'], $AResult_User['data'][0]->password)) {
                // 密码正确,操作结果
                if (Sql::UPDATE("UPDATE `index`.xf_user SET `login_time`='" . time() . "',`login_ip`='" . $_SERVER['REMOTE_ADDR'] . "' WHERE `username`='{$PostData['user']}' OR `email`='{$PostData['user']}'")) {
                    // 输出结果
                    Normal::Output(200);
                } else Normal::Output(300);
            } else Normal::Output(403);
        } else Normal::Output(601);
    } else Normal::Output(402);
} else Normal::Output(100);