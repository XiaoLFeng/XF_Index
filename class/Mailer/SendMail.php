<?php
/*
 * Copyright © 2016 - 2023 筱锋xiao_lfeng. All Rights Reserved.
 * 开发开源遵循 MIT 许可，若需商用请联系开发者
 * https://www.x-lf.com/
 */

namespace Mailer;

use Mailer\PHPMailer\Exception;
use Mailer\PHPMailer\PHPMailer;

class SendMail
{
    public static int $EmailType;
    public static string $EmailReceiver;

    private array $ConfigData;
    public static int $ExpTime;
    public static string $WebTitle;

    private PHPMailer $Mail;

    /**
     * @return void 导入文件，无具体返回值
     */
    protected function __consort()
    {
        // 文件导入
        $Array_ConfigData = null;
        $FileData = fopen(dirname(__FILE__, 3) . "/setting.inc.json", 'r');
        while (!feof($FileData))
            $Array_ConfigData .= fgetc($FileData);
        $Array_ConfigData = json_decode($Array_ConfigData, JSON_UNESCAPED_UNICODE);
        $this->ConfigData = json_decode($Array_ConfigData, JSON_UNESCAPED_UNICODE)["Smtp"];
        fclose($FileData);
        // 参数赋予
        self::$ExpTime = $Array_ConfigData["Mail"]['ExpDate'];
        self::$WebTitle = $Array_ConfigData["Web"]['Title'];

        // 类导入
        $this->Mail = new PHPMailer(true);
    }

    /**
     * 检查通信协议是 HTTP 还是 HTTPS
     * @param string $Smtp_Type [Port]获取端口值，[Secure]连接模式
     * @return mixed|string|null
     */
    private function SSLCheck(string $Smtp_Type)
    {
        if ($Smtp_Type == 'Port')
            return $_SERVER['SERVER_PORT'] != '443' ? $this->ConfigData['Port'] : $this->ConfigData['SecurePort'];
        elseif ($Smtp_Type == 'Secure')
            if ($_SERVER['SERVER_PORT'] != '443')
                return 'TLS';
            else
                return 'ssl';
        else
            return null;
    }

    /**
     * 发件基础内容（调用）
     * 说明：
     *
     * 1. [EmailType(int)] 邮件发送类型
     *   - [1] 站点注册邮件
     *   - [2] 站点邮件登录
     * @param string $EmailReceiver 邮件接收方（邮箱地址）
     * @param int $EmailType 发送邮件类型
     * @param string $OtherPush 其他备注内容，例如激活码
     * @return bool 邮件发送成功返回 true 否则返回 false
     */
    public function PostMail(string $EmailReceiver, int $EmailType, string $OtherPush = null): bool
    {
        self::$EmailType = $EmailType;
        self::$EmailReceiver = $EmailReceiver;
        // 尝试邮件发送
        try {
            // 服务器配置
            $this->Mail->CharSet = "UTF-8";
            $this->Mail->SMTPDebug = 0;
            $this->Mail->isSMTP();
            $this->Mail->Host = $this->ConfigData['Host'];
            $this->Mail->SMTPAuth = $this->ConfigData['SmtpAuth'];
            $this->Mail->Username = $this->ConfigData['Username'];
            $this->Mail->Password = $this->ConfigData['Password'];
            $this->Mail->SMTPSecure = $this->SSLCheck('Secure');
            $this->Mail->Port = $this->SSLCheck('Port');
            $this->Mail->setFrom($this->ConfigData['User'], $this->ConfigData['Name']);
            $this->Mail->addAddress($EmailReceiver);

            // 发件编写
            if ($EmailType == 1) $this->EmailRegister($OtherPush);
            else if ($EmailType == 2) $this->EmailLogin($OtherPush);

            $this->Mail->send();
            return true;
        } catch (Exception $e) {
            //echo '邮件发送失败：', $this->Mail->ErrorInfo;
            return false;
        }
    }

    private function EmailRegister(string $Input_Code): void
    {
        $this->Mail->Subject = $this->ConfigData['Name'] . ' - 站点注册'; // 邮箱标题
        $this->Mail->Body = MailTemplate::Templates($Input_Code);
    }

    private function EmailLogin(string $OtherPush)
    {
        $this->Mail->Subject = $this->ConfigData['Name'] . ' - 邮箱登录验证码'; // 邮箱标题
        $this->Mail->Body = MailTemplate::Templates($Input_Code);
    }
}