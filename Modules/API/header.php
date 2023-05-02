<?php
/*
 * Copyright © 2016 - 2023 筱锋xiao_lfeng. All Rights Reserved.
 * 开发开源遵循 MIT 许可，若需商用请联系开发者
 * https://www.x-lf.com/
 */

$Array_ConfigData = null;

// 从配置文件获取参数
$FileData = fopen(dirname(__FILE__, 3) . "/setting.inc.json", 'r');
while (!feof($FileData))
    $Array_ConfigData .= fgetc($FileData);
$Array_ConfigData = json_decode($Array_ConfigData, JSON_UNESCAPED_UNICODE);
fclose($FileData);