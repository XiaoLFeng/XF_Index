<?php
/*
 * Copyright © 2016 - 2023 筱锋xiao_lfeng. All Rights Reserved.
 * 开发开源遵循 MIT 许可，若需商用请联系开发者
 * https://www.x-lf.com/
 */

/**
 * @var Array $Json_Data 最终数据编译输出
 */

// 类引入
require dirname(__FILE__, 5) . "/class/Token.php";
// 类构建
$ClassToken = new Token(40, true);

// 函数构建
if (empty($_COOKIE['Token'])) {
    if (preg_match('/^Token:/', $ClassToken->getToken())) {
        // 不匹配Token
        $Data_Token = substr($ClassToken->getToken(), 6);
        // 生成Token
        $Json_Data = [
            'output' => 'Success',
            'code' => 200,
            'data' => [
                'message' => '生成完毕',
                'token' => $Data_Token,
            ],
        ];
    } else {
        $Json_Data = [
            'output' => $ClassToken->getToken(),
            'code' => 502,
            'data' => [
                'message' => '按需检查对应错误',
            ],
        ];
    }
} else {
    $Json_Data = [
        'output' => 'TokenNotEmpty',
        'code' => 403,
        'data' => [
            'message' => "Token不为空",
        ],
    ];
}
// 输出JSON
echo json_encode($Json_Data, JSON_UNESCAPED_UNICODE);