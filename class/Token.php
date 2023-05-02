<?php
/*
 * Copyright © 2016 - 2023 筱锋xiao_lfeng. All Rights Reserved.
 * 开发开源遵循 MIT 许可，若需商用请联系开发者
 * https://www.x-lf.com/
 */

class Token
{
    /** @var int|null Token生成长度 */
    public int $Data_TokenLong;
    /** @var string 生成的Token或获取的Token */
    public ?string $Data_Token = null;

    /**
     * @param int|null $Token_Long 获取Token计算长度
     * @param bool $Token_Create 是否为 Token 创建模式
     */
    public function __construct(int $Token_Long)
    {
        $this->Data_TokenLong = $Token_Long;
    }

    /**
     * 获取一个新的 Token 值
     * 说明：
     *
     * 1. Token长度说明
     *   - 在Token长度小于5时判断Token为错误类型，不允许生成Token（过于简单）
     *   - 在Token长度大于等于5小于等于20时判断Token随机生成16进制随机数，若要进行判断，请使用SESSION或COKKIE进行自行编译判断
     *   - 在Token长度大于20不大于等于40时创建带时间Token，进行判断可直接使用类中 examineToken 函数进行判断是否正确，请注意，依旧需要使用COOKIE进行存储Token
     * @return string Token检查错误返回对应错误代码，当Token正确生成输出结果为Token:xxx
     */
    public function getToken(): string
    {
        $this->Data_Token = null;
        // 令牌合法化检测
        if ($this->checkToken() == "SUCCESS") {
            // Token设计
            if ($this->Data_TokenLong <= 20) {
                for ($CC_i = 0; $CC_i < $this->Data_TokenLong; $CC_i++) {
                    $Data_RandNumber = dechex(rand(0, 15));
                    $this->Data_Token .= $Data_RandNumber;
                }
            } else if ($this->Data_Token <= 40) {
                for ($CC_i = 0; $CC_i < 5; $CC_i++) {
                    $Data_RandNumber = dechex(rand(0, 15));
                    $this->Data_Token .= $Data_RandNumber;
                }
                $this->Data_Token .= (int)hexdec($this->Data_Token) % 7;
                $this->Data_Token .= (int)hexdec($this->Data_Token) % 2;
                $this->Data_Token .= date("ymdHi");
                $this->Data_Token .= (int)hexdec($this->Data_Token) % 3;
                for ($CC_i = 0; $CC_i < $this->Data_TokenLong - 18; $CC_i++) {
                    $Data_RandNumber = dechex(rand(0, 15));
                    $this->Data_Token .= $Data_RandNumber;
                }
            }
            // 结果输出
            return "Token:" . $this->Data_Token;
        } else
            return $this->checkToken();
    }

    /**
     * 令牌合法化检测（令牌检测需要必须大于5位数，否则视为违法令牌）
     * 返回值：
     *
     * - TokenTooShort [令牌太短]
     * - TokenTooLong [令牌太长]
     * - NotAvailable [非令牌获取模式]
     * @return string 返回上述结果
     */
    private function checkToken(): string
    {
        if ($this->Data_TokenLong < 5)
            return "TokenTooShort";
        else if ($this->Data_TokenLong > 40)
            return "TokenTooLong";
        return "SUCCESS";
    }

    /**
     * Token检查是否合法
     * 说明：
     *
     * 1. Token长度说明
     *     - Token长度在小于5为过短，非正常Token
     *     - Token长度在大于等于5小于等于20为输出随机16进制数字，此情况中此函数不予检测，请自行构建
     *     - Token长度在大于20小于等于40为输出带时间Token，可直接使用此函数进行判断，合法Token并且通过验证返回SUCCESS
     *     - Token长度大于40为非法Token
     * 2. 返回结果说明
     *     - SUCCESS [验证通过]
     *     - FAIL [检查不通过]
     *     - NotAvailable [不支持此数据（也就是说你的Token长度为大于等于5小于等于20的情况下]
     *     - TimeFail [验证超时]
     * @param string $Token Token检查，输入Token记录值，计算Token是否合法
     * @return string 如果检查通过输出SUCCESS，错误输出有多种
     */
    public function examineToken(string $Token, int $Token_ExpDate): string
    {
        $this->Data_Token = $Token;
        // Token正规化检查
        if ($this->Data_TokenLong >= 5 && $this->Data_TokenLong <= 20)
            return "NotAvailable";
        else if ($this->Data_TokenLong <= 40) {
            if (hexdec(substr($this->Data_Token, 1, 5)) % 7 != substr($this->Data_Token, 6, 1))
                return "FAIL";
            if (hexdec(substr($this->Data_Token, 1, 6)) % 2 != substr($this->Data_Token, 7, 1))
                return "FAIL";
            if (strtotime(substr($this->Data_Token, 8, 10)) + $Token_ExpDate <= time())
                return "TimeFail";
            if (hexdec(substr($this->Data_Token, 1, 17)) % 3 == substr($this->Data_Token, 18, 1))
                return "FAIL";
        }
        return "SUCCESS";
    }
}