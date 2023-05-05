<?php
/*
 * Copyright © 2016 - 2023 筱锋xiao_lfeng. All Rights Reserved.
 * 开发开源遵循 MIT 许可，若需商用请联系开发者
 * https://www.x-lf.com/
 */


namespace Mailer;

require_once dirname(__FILE__, 3) . "/class/Mailer/PHPMailer/PHPMailer.php";
require_once dirname(__FILE__, 3) . "/class/Mailer/PHPMailer/Exception.php";
require_once dirname(__FILE__, 3) . "/class/Mailer/PHPMailer/SMTP.php";
require_once dirname(__FILE__, 3) . "/class/Mailer/MailTemplate.php";

class SendMail
{
    public static int $EmailType;
    public static string $EmailReceiver;

    protected static array $ConfigData;
    public static int $ExpTime;
    public static string $WebTitle;
    protected static ?string $GCode;
    protected PHPMailer $Mail;
    public static string $SendMailError;
    public static string $getDomain;

    /**
     * @return void 导入文件，无具体返回值
     */
    public function __construct()
    {
        // 文件导入
        $Array_ConfigData = null;
        $FileData = fopen(dirname(__FILE__, 3) . "/setting.inc.json", 'r');
        while (!feof($FileData))
            $Array_ConfigData .= fgetc($FileData);
        $Array_ConfigData = json_decode($Array_ConfigData, JSON_UNESCAPED_UNICODE);
        self::$ConfigData = $Array_ConfigData["Smtp"];
        fclose($FileData);
        // 参数赋予
        self::$ExpTime = $Array_ConfigData["Mail"]['ExpDate'];
        self::$WebTitle = $Array_ConfigData["Web"]['Title'];
        self::$getDomain = $Array_ConfigData["Web"]['Domain'];

        // 导入类
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
            return $_SERVER['SERVER_PORT'] != '443' ? self::$ConfigData['Port'] : self::$ConfigData['SecurePort'];
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
        self::$GCode = $OtherPush;

        // 尝试邮件发送
        try {
            // 服务器配置
            $this->Mail->CharSet = "UTF-8";
            $this->Mail->SMTPDebug = 0;
            $this->Mail->isSMTP();
            $this->Mail->Host = self::$ConfigData['Host'];
            $this->Mail->SMTPAuth = self::$ConfigData['SmtpAuth'];
            $this->Mail->Username = self::$ConfigData['Username'];
            $this->Mail->Password = self::$ConfigData['Password'];
            $this->Mail->SMTPSecure = $this->SSLCheck('Secure');
            $this->Mail->Port = $this->SSLCheck('Port');
            $this->Mail->setFrom(self::$ConfigData['User'], self::$ConfigData['Name']);
            $this->Mail->addAddress($EmailReceiver);
            $this->Mail->isHTML(true);

            // 发件编写
            if ($EmailType == 1) $this->EmailRegister();
            else if ($EmailType == 2) $this->EmailLogin();

            $this->Mail->send();
            return true;
        } catch (\Exception $e) {
            self::$SendMailError = $this->Mail->ErrorInfo;
            return false;
        }
    }

    protected function EmailRegister(): void
    {
        $this->Mail->Subject = self::$ConfigData['Name'] . ' - 站点注册'; // 邮箱标题
        $this->Mail->Body = MailTemplate::Templates(self::$GCode);
    }

    protected function EmailLogin(): void
    {
        $this->Mail->Subject = self::$ConfigData['Name'] . ' - 邮箱登录验证码'; // 邮箱标题
        $this->Mail->Body = MailTemplate::Templates();
    }
}