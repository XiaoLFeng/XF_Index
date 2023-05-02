<?php
/*
 * Copyright © 2016 - 2023 筱锋xiao_lfeng. All Rights Reserved.
 * 开发开源遵循 MIT 许可，若需商用请联系开发者
 * https://www.x-lf.com/
 */

/**
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
    if (!empty($_COOKIE['user'])) {

    } else {
        $Json_Data = [
            'output' => 'NoLogin',
            'code' => 502,
            'data' => [
                'message' => '需要登陆',
            ],
        ];
    }
} else {
    // 编译输出
    Normal::Output(100);
}