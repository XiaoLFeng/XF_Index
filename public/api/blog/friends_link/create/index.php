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
include dirname(__FILE__, 6) . "/Modules/API/header.php";
require dirname(__FILE__, 6) . "/class/Sql.php";
require dirname(__FILE__, 6) . "/class/Normal.php";

// 数据获取类型
$PostData = file_get_contents('php://input');
$PostData = json_decode($PostData, true);

// 逻辑构建
if ($Array_ConfigData['Session'] == $_SERVER['HTTP_SESSION']) {
    // 检查用户是否登录
    $Data_UserUID = null;
    if (!empty($_COOKIE['user'])) {
        $AResult_User = Sql::SELECT("SELECT * FROM `index`.xf_user WHERE `uid`={$_COOKIE['uid']}");
        if ($AResult_User['output'] == 'Success')
            $Data_UserUID = $AResult_User['data'][0]->uid;
    }
    // 检查数据是否合法
    if (!DataCheck()) {
        // 检查数据库内是否有数据
        $AResult_BlogLink = Sql::SELECT("SELECT * FROM `index`.xf_blog_link WHERE `name`='{$PostData['blog_name']}' OR `owner_email`='{$PostData['user_email']}' OR `url`='{$PostData['blog_url']}'");
        if ($AResult_BlogLink['output'] == 'EmptyResult') {
            // 没有数据执行插入
            if (Sql::INSERT("INSERT INTO `index`.xf_blog_link (`name`, `url`, `owner_email`, `introduce`, `icon`, `rss_judge`, `rss`, `serverhost`, `adv`, `blog_ssl`, `location`, `sel_color`, `deleted`) VALUES ('{$PostData['blog_name']}','{$PostData['blog_url']}','{$PostData['user_email']}','{$PostData['blog_introduce']}','{$PostData['blog_icon']}','{$PostData['blog_rss_judge']}','{$PostData['blog_rss']}','{$PostData['blog_host']}',{$PostData['blog_adv_judge']},{$PostData['blog_ssl_judge']},0,0,0)")) {
                // 插入成功返回结果
                Normal::Output(200);
            } else Normal::Output(300);
        } else {
            // 检查博客主要数据是否重复
            if ($AResult_BlogLink['data'][0]['owner_email'] == $PostData['user_email']) {
                Normal::CustomOutput('UserEmailDuplication', 403, '用户邮箱与数据库重复');
            } else if ($AResult_BlogLink['data'][0]['name'] == $PostData['blog_name']) {
                Normal::CustomOutput('BlogNameDuplication', 403, '博客名字与数据库重复');
            } else if ($AResult_BlogLink['data'][0]['url'] == $PostData['blog_url'])
                Normal::CustomOutput('BlogUrlDuplication', 403, '博客地址与数据库重复');// 数据库信息查询不正确
        }
    }
} else Normal::Output(100); // SESSION是否合法

/**
 * @return false|void 返回结果为
 */
function DataCheck()
{
    global $PostData;
    if (preg_match('/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/', $PostData['user_email'])) {
        if (preg_match('/^[一-龥0-9A-Za-z_\']+$/', $PostData['blog_name'])) {
            if (preg_match('/^[一-龥0-9A-Za-z_\']+$/', $PostData['blog_introduce'])) {
                if (preg_match('/^http://([\w-]+\.)+[\w-]+(/[\w-./?%&=]*)?$/', $PostData['blog_url'])) {
                    if (preg_match('/^http://([\w-]+\.)+[\w-]+(/[\w-./?%&=]*)?$/', $PostData['blog_icon'])) {
                        if ((string)$PostData['blog_ssl_judge'] == "true" || (string)$PostData['blog_ssl_judge'] == "false") {
                            if ((string)$PostData['blog_adv_judge'] == "true" || (string)$PostData['blog_adv_judge'] == "false") {
                                if ((string)$PostData['blog_rss_judge'] == "true" || (string)$PostData['blog_rss_judge'] == "false") {
                                    if (preg_match('/^http://([\w-]+\.)+[\w-]+(/[\w-./?%&=]*)?$/', $PostData['blog_rss'])) {
                                        if (preg_match('/^[一-龥0-9A-Za-z_\']+$/', $PostData['blog_host'])) {
                                            if (preg_match('/^[0-9]+$/', $PostData['blog_color'])) {
                                                return false;
                                            } else Normal::Output(410);
                                        } else Normal::Output(409); // 地址格式错误（RSS地址）
                                    } else Normal::Output(407, null, 'blog_rss'); // 地址格式错误（RSS地址）
                                } else Normal::Output(408, null, 'blog_rss_judge'); // 不符合布尔值参数
                            } else Normal::Output(408, null, 'blog_adv_judge'); // 不符合布尔值参数
                        } else Normal::Output(408, null, 'blog_ssl_judge'); // 不符合布尔值参数
                    } else Normal::Output(407, null, 'blog_icon'); // 地址格式错误（图标地址）
                } else Normal::Output(407, null, 'blog_url'); // 地址格式错误
            } else Normal::Output(406); // 博客描述格式不符合
        } else Normal::Output(405); // 博客名字格式不符合
    } else Normal::Output(401); // 邮箱是否合法
}