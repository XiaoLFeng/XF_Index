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
if ($Array_ConfigData['Session'] == $_SERVER['SESSION']) {
    // 检查用户
    if (empty($PostData['user']) && preg_match('/^[0-9]+$/', $PostData['user'])) {
        // 检查用户是否在数据库内且为管理员
        $AResult_User = Sql::SELECT("SELECT * FROM `index`.xf_user WHERE `uid`='{$PostData['user']}'");
        if ($AResult_User == 'Success') {
            if ($AResult_User['data'][0]['permission'] == 1) {
                // 审批是否通过（审批不通过直接删除，而非修改退回），检查数据是否存在
                $AResult_Blog = Sql::SELECT("SELECT * FROM `index`.xf_blog_link WHERE `id`='{$PostData['blog_id']}'");
                if ($AResult_Blog['output'] == 'Success') {
                    if ($PostData['check']) {
                        // 检查数据
                        if (!DataCheck()) {
                            // 数据检查通过，上传数据并通过位置
                            if (preg_match('/^[0-9]{1,4}/', $PostData['blog_location'])) {
                                // 修改数据
                                if (Sql::UPDATE("UPDATE `index`.xf_blog_link SET `owner_email`='{$PostData['user_email']}',`name`='{$PostData['blog_name']}',`url`='{$PostData['blog_url']}',`introduce`='{$PostData['blog_introduce']}',`icon`='{$PostData['blog_icon']}',`rss_judge`='{$PostData['blog_rss_judge']}',`rss`='{$PostData['blog_rss']}',`serverhost`='{$PostData['blog_host']}',`adv`='{$PostData['blog_adv_judge']}',`blog_ssl`='{$PostData['blog_ssl_judge']}',`location`='{$PostData['blog_location']}',`sel_color`={$PostData['blog_color']} WHERE `id`='{$PostData['blog_id']}'")) {
                                    Normal::Output(200);
                                } else Normal::Output(302);
                            } else Normal::Output(410); // 添加位置错误
                        }
                    } else {
                        // 删除数据
                        if (Sql::DELETE("DELETE FROM `index`.xf_blog_link WHERE `id`='{$PostData['blog_id']}'"))
                            Normal::Output(200);
                        else Normal::Output(303, null, "Blog"); // 数据库删除失败
                    }
                } else Normal::Output(301, null, "Blog"); // 数据库查询失败
            } else Normal::Output(701); // 管理员权限拒绝
        } else if ($AResult_User == 'EmptyResult') {
            Normal::Output(601); // 没有这个用户
        } else Normal::Output(301, null, "User"); // 数据库查询失败
    } else Normal::Output(402); // 用户格式不正确
} else Normal::Output(100); // 通讯密钥错误

/**
 * @return false|void 返回结果为错误Json，否则返回false表示检查完成
 */
function DataCheck()
{
    global $PostData;
    if (preg_match('/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/', $PostData['user_email'])) {
        if (preg_match('/^[一-龥0-9A-Za-z_\']+$/', $PostData['blog_name'])) {
            if (preg_match('/^[一-龥0-9A-Za-z_\']+$/', $PostData['blog_introduce'])) {
                if (preg_match('/[a-zA-Z0-9][-a-zA-Z0-9]{0,62}(\.[a-zA-Z0-9][-a-zA-Z0-9]{0,62})+\.?/', $PostData['blog_url'])) {
                    if (preg_match('/^http://([\w-]+\.)+[\w-]+(/[\w-./?%&=]*)?$/', $PostData['blog_icon'])) {
                        if ((string)$PostData['blog_ssl_judge'] == "true" || (string)$PostData['blog_ssl_judge'] == "false") {
                            if ((string)$PostData['blog_adv_judge'] == "true" || (string)$PostData['blog_adv_judge'] == "false") {
                                if ((string)$PostData['blog_rss_judge'] == "true" || (string)$PostData['blog_rss_judge'] == "false") {
                                    if (empty($PostData['blog_rss']) || preg_match('/^http://([\w-]+\.)+[\w-]+(/[\w-./?%&=]*)?$/', $PostData['blog_rss'])) {
                                        if (preg_match('/^[一-龥0-9A-Za-z_\']+$/', $PostData['blog_host'])) {
                                            if (empty($PostData['blog_color']) || preg_match('/^[0-9]+$/', $PostData['blog_color'])) {
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