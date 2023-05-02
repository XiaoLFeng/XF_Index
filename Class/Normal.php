<?php
/*
 * Copyright © 2016 - 2023 筱锋xiao_lfeng. All Rights Reserved.
 * 开发开源遵循 MIT 许可，若需商用请联系开发者
 * https://www.x-lf.com/
 */

class Normal
{

    /**
     * Json标准输出部分
     * @param int $gType 输入数字类型输出不同的段落格式
     * @param array|null $OtherArray 其他需要附带，不属于标准Json输出内容部分
     * @return void
     */
    public static function Output(int $gType, array $OtherArray = null)
    {
        $Json_Data = [
            'output' => self::OutputMessage($gType, 0),
            'code' => self::OutputMessage($gType, 1),
            'data' => [
                'message' => self::OutputMessage($gType, 2),
            ],
        ];
        if (!empty($OtherArray)) {
            $Json_Data['data']['data'] = $OtherArray;
        }
        // Json 输出
        header(self::HttpStatusCode(self::OutputMessage($gType, 1)));
        echo json_encode($Json_Data, JSON_UNESCAPED_UNICODE);
    }

    /**
     * 输出状态监控
     * @param int $gType
     * @param int $bCode
     * @return int|string|null
     */
    private static function OutputMessage(int $gType, int $bCode)
    {
        if ($gType == 100)
            if ($bCode == 0) return 'SessionError';
            else if ($bCode == 1) return 502;
            else return "通讯密钥为空或错误";
        else if ($gType == 200)
            if ($bCode == 0) return 'Success';
            else if ($bCode == 1) return 200;
            else return "操作成功";
        else
            return null;
    }

    /**
     * HTTP状态码反馈
     * @param int $Input_State 输入HTTP状态码数字
     * @return string 反馈对应 PHP 状态码 header
     */
    private static function HttpStatusCode(int $Input_State): string
    {
        if ($Input_State == 200) return 'HTTP/1.1 200 OK';
        else if ($Input_State == 100) return 'HTTP/1.1 100 Continue';
        else if ($Input_State == 101) return 'HTTP/1.1 101 Switching Protocols';
        else if ($Input_State == 201) return 'HTTP/1.1 201 Created';
        else if ($Input_State == 202) return 'HTTP/1.1 202 Accepted';
        else if ($Input_State == 203) return 'HTTP/1.1 203 Non-Authoritative Information';
        else if ($Input_State == 204) return 'HTTP/1.1 204 No Content';
        else if ($Input_State == 205) return 'HTTP/1.1 205 Reset Content';
        else if ($Input_State == 206) return 'HTTP/1.1 206 Partial Content';
        else if ($Input_State == 300) return 'HTTP/1.1 300 Multiple Choices';
        else if ($Input_State == 301) return 'HTTP/1.1 301 Moved Permanently';
        else if ($Input_State == 302) return 'HTTP/1.1 302 Found';
        else if ($Input_State == 303) return 'HTTP/1.1 303 See Other';
        else if ($Input_State == 304) return 'HTTP/1.1 304 Not Modified';
        else if ($Input_State == 305) return 'HTTP/1.1 305 Use Proxy';
        else if ($Input_State == 307) return 'HTTP/1.1 307 Temporary Redirect';
        else if ($Input_State == 400) return 'HTTP/1.1 400 Bad Request';
        else if ($Input_State == 401) return 'HTTP/1.1 401 Unauthorized';
        else if ($Input_State == 402) return 'HTTP/1.1 402 Payment Required';
        else if ($Input_State == 403) return 'HTTP/1.1 403 Forbidden';
        else if ($Input_State == 404) return 'HTTP/1.1 404 Not Found';
        else if ($Input_State == 405) return 'HTTP/1.1 405 Method Not Allowed';
        else if ($Input_State == 406) return 'HTTP/1.1 406 Not Acceptable';
        else if ($Input_State == 407) return 'HTTP/1.1 407 Proxy Authentication Required';
        else if ($Input_State == 408) return 'HTTP/1.1 408 Request Time-out';
        else if ($Input_State == 409) return 'HTTP/1.1 409 Conflict';
        else if ($Input_State == 410) return 'HTTP/1.1 410 Gone';
        else if ($Input_State == 411) return 'HTTP/1.1 411 Length Required';
        else if ($Input_State == 412) return 'HTTP/1.1 412 Precondition Failed';
        else if ($Input_State == 413) return 'HTTP/1.1 413 Request Entity Too Large';
        else if ($Input_State == 414) return 'HTTP/1.1 414 Request-URI Too Large';
        else if ($Input_State == 415) return 'HTTP/1.1 415 Unsupported Media Type';
        else if ($Input_State == 416) return 'HTTP/1.1 416 Requested range not satisfiable';
        else if ($Input_State == 417) return 'HTTP/1.1 417 Expectation Failed';
        else if ($Input_State == 500) return 'HTTP/1.1 500 Internal Server Error';
        else if ($Input_State == 501) return 'HTTP/1.1 501 Not Implemented';
        else if ($Input_State == 502) return 'HTTP/1.1 502 Bad Gateway';
        else if ($Input_State == 503) return 'HTTP/1.1 503 Service Unavailable';
        else return 'HTTP/1.1 504 Gateway Time-out';
    }
}