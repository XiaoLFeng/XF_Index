<?php
/*
 * Copyright © 2016 - 2023 筱锋xiao_lfeng. All Rights Reserved.
 * 开发开源遵循 MIT 许可，若需商用请联系开发者
 * https://www.x-lf.com/
 */

namespace Mailer;

class MailTemplate
{
    private static string $GCode;
    private static int $NowTime;

    /**
     * 检查使用邮件发送模板
     * @param string $G_code 获取后端发送来的验证码用于发送
     * @return string|null 需要返回值，返回HTML信息给邮箱模板用于发送
     */
    public static function Templates(string $G_code): ?string
    {
        // 赋值给全局
        self::$GCode = $G_code;
        self::$NowTime = time();

        // 判断发送内容
        if (SendMail::$EmailType == 1) return self::Register();

        return null;
    }

    /**
     * 注册邮件模板
     * @return string 返回 HTML 方式的 Mail
     */
    private static function Register(): string
    {
        // 变量获取
        $getTitle = SendMail::$WebTitle;
        $getNowTime = self::$NowTime;
        $getReceiver = SendMail::$EmailReceiver;
        $getEndTime = date("Y年m月d日 H:i:s", time() + SendMail::$ExpTime);
        $getExpTime = (double)SendMail::$ExpTime / 60;
        $getYear = date('Y');
        $getDomain = $_SERVER['SERVER_NAME'];
        // 结果返回
        return <<<EOF
            <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
            <html xmlns="http://www.w3.org/1999/xhtml">
            <head>
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                <title>Mail</title>
                <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
            </head>
            <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse;border: 1px solid #cccccc;box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.175)">
                <tr>
                    <td align="center" bgcolor="#70bbd9" style="padding: 30px 0 30px 0; font-size: 30px;">$getTitle</td>
                </tr>
                <tr>
                    <td>
                        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="padding: 30px 30px 30px 30px;">
                            <tr>
                                <td style="padding: 10px 0px 30px 0px;color: #08212b; font-family: Arial, sans-serif; font-size: 10px;">
                                    发送时间： <b>$getNowTime</b>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 0px 0px 10px 0px;color: #000000; font-family: Arial, sans-serif; font-size: 24px;">
                                    Dear. <a style="text-decoration: none;color: #198754;" href="mailto:$getReceiver">$getReceiver</a>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding: 0px 5px 5px 0px;color: #000000; font-family: Arial, sans-serif; font-size: 20px;">
                                    <a href="$getDomain/account/activation.php"><button style="background-color: #008CBA;font-size: 16px;border-radius: 8px;">点击激活</button></a>
                                    <br/>
                                    您的身份激活 <strong>$getExpTime</strong> 分钟内有效，此身份激活为 <strong>账户注册</strong> 使用。<br/>
                                    有效期至：$getEndTime
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td bgcolor="#f0f0f0" style="padding: 30px 20px 30px 20px;">
                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                            <tr>
                                <td style="font-family: Arial, sans-serif; font-size: 14px;">
                                    <font style="color: grey;">&copy; 2022 - $getYear. $getTitle All Rights Reserved.</font><br/>
                                    <font style="color: grey;">本邮件为自动发出，请勿直接回复</font>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <tr>
                <td style="padding: 30px 0 20px 0;"></td>
            </tr>
            </html>
            EOF;
    }


}