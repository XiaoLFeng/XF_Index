<?php
/*
 * Copyright © 2016 - 2023 筱锋xiao_lfeng. All Rights Reserved.
 * 开发开源遵循 MIT 许可，若需商用请联系开发者
 * https://www.x-lf.com/
 */


/**
 * @var array $Json_Data 最终数据编译输出
 * @var array $Array_ConfigData 配置文件
 * @var array $AResult_Blog
 */

// 引入配置
include dirname(__FILE__, 6) . "/Modules/API/header.php";
require dirname(__FILE__, 6) . "/class/Sql.php";
require dirname(__FILE__, 6) . "/class/Normal.php";

// 数据获取类型
$GetData = [
    'type' => urldecode(htmlspecialchars($_GET['type'])),
    'search' => urldecode(htmlspecialchars($_GET['search'])),
    'link' => urldecode(htmlspecialchars($_GET['link'])),
    'user' => urldecode(htmlspecialchars($_GET['user'])),
];

// 逻辑构建
if ($Array_ConfigData['Session'] == $_SERVER['HTTP_SESSION']) {
    // 判断赋值
    $GetData['user'] == 1 ? $Data_UserSee = 'AND `location`!=0 AND `deleted`=0' : $Data_UserSee = '';

    // 检查类型是否合法
    if ($GetData['type'] == 0) { // 广泛查询
        // 查询数据库
        $AResult_Blog = Sql::SELECT("SELECT * FROM `index`.xf_blog_link");
        if ($AResult_Blog['output'] == 'Success') {
            Normal::CustomOutput('Success', 200, '操作成功', $AResult_Blog['data']);
        } else if ($AResult_Blog['output'] == 'EmptyResult') {
            Normal::CustomOutput('EmptyResult', 200, '没有数据');
        } else Normal::Output(301);
    } else if ($GetData['type'] == 1) { // 特定数据查询(一定查询)
        if (empty($GetData['search']) && empty($GetData['link'])) { // 查找数据库
            $AResult_Blog = Sql::SELECT("SELECT * FROM `index`.xf_blog_link WHERE `name` = '{$GetData['search']}' OR `url` = '{$GetData['link']}' $Data_UserSee");
            if ($AResult_Blog['output'] == 'Success') {
                Normal::CustomOutput('Success', 200, '操作成功', $AResult_Blog['data']);
            } else Normal::Output(301);
        } else Normal::Output(501);
    } else if ($GetData['type'] == 2) { // 模糊查询
        if (!empty($GetData['search'])) {// 查询数据库
            $AResult_Blog = Sql::SELECT("SELECT * FROM `index`.xf_blog_link WHERE `owner_email` LIKE '%{$GetData['search']}%' OR `name` LIKE '%{$GetData['search']}%' OR `url` LIKE '%{$GetData['search']}%' $Data_UserSee");
            if ($AResult_Blog['output'] == 'Success') {
                Normal::CustomOutput('Success', 200, '操作成功', $AResult_Blog['data']);
            } else Normal::Output(301);
        } else Normal::Output(501);
    } else Normal::Output(404);
} else Normal::Output(100);