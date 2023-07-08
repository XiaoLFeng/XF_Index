<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title>Mail</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<table align="center" border="0" cellpadding="0" cellspacing="0" width="600"
       style="border-collapse: collapse;border: 1px solid #cccccc;box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.175)">
    <tr>
        <td align="center" bgcolor="#70bbd9" style="padding: 30px 0 30px 0; font-size: 30px;"><b>{{ env('APP_NAME') }}</b></td>
    </tr>
    <tr>
        <td>
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="padding: 30px 30px 30px 30px;">
                <tr>
                    <td style="padding: 10px 0px 30px 0px;color: #08212b; font-family: Arial, sans-serif; font-size: 10px;">
                        时间： <b>{{ date('Y-m-d H:i:s') }}</b>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 0px 0px 10px 0px;color: #000000; font-family: Arial, sans-serif; font-size: 24px;">
                        Dear. <a style="text-decoration: none;color: #198754;" href="mailto:{{ $sendEmail['userEmail'] }}">{{ $sendEmail['userEmail'] }}</a>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 0px 5px 5px 0px;color: #000000; font-family: Arial, sans-serif; font-size: 16px;">
                        您好 <a style="text-decoration: none;color: #198754;" href="{{ $sendEmail['userUrl'] }}"><b> {{ $sendEmail['userBlog'] }}</b></a> 的站长：<b>
                            {{ $sendEmail['userEmail'] }}</b><br/>
                        您在本博客（<a style="text-decoration: none;color: #198754;" href="{{ env('APP_BLOG') }}">{{ env('APP_NAME') }}</a>）自主修改友链<br/>
                        邮件为通知您您已成功修改友链，修改立即生效，我们告知您已做出了修改，若您未执行修改请立刻联系站长
                        {{ $sqlAuthor }}({{ $sqlEmail }})
                        <hr/>
                        这是您现在的信息：<br/>
                        <ul>
                            <li>博主邮箱：{{ $blog->blogOwnEmail }}</li>
                            <li>贵站名字：{{ $blog->blogName }}</li>
                            <li>贵站地址：{{ $blog->blogUrl }}</li>
                            <li>图片地址：{{ $blog->blogIcon }}</li>
                            <li>贵站介绍：{{ $blog->blogDescription }}</li>
                            @if(!empty($blog->blogRemark))
                                <li>备注内容：{{ $blog->blogRemark }}</li>
                            @endif
                            @if($blog->blogRssJudge == 1)
                                <li>RSS地址：{{ $blog->blogRSS }}</li>
                            @endif
                        </ul>
                        <hr/>
                        这是您以前的修改信息：<br/>
                        <ul>
                            <li>博主邮箱：{{ $oldBlog->blogOwnEmail }}</li>
                            <li>贵站名字：{{ $oldBlog->blogName }}</li>
                            <li>贵站地址：{{ $oldBlog->blogUrl }}</li>
                            <li>图片地址：{{ $oldBlog->blogIcon }}</li>
                            <li>贵站介绍：{{ $oldBlog->blogDescription }}</li>
                            @if(!empty($oldBlog->blogRemark))
                                <li>备注内容：{{ $oldBlog->blogRemark }}</li>
                            @endif
                            @if($oldBlog->blogRssJudge == 1)
                                <li>RSS地址：{{ $oldBlog->blogRSS }}</li>
                            @endif
                        </ul>
                        <hr/>
                        此邮件为凭证，若发生意外修改请使用此邮件提交于站长！谢谢您对本站的支持！<br/>
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
                        <font style="color: grey;">&copy; 2022 - {{ date('Y') }}. {{ env('APP_NAME') }} All Rights Reserved.</font><br/>
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
