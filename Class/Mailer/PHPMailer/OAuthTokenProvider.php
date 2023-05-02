<?php
/*
 * Copyright © 2016 - 2023 筱锋xiao_lfeng. All Rights Reserved.
 * 开发开源遵循 MIT 许可，若需商用请联系开发者
 * https://www.x-lf.com/
 */

namespace Mailer\PHPMailer;

/**
 * OAuthTokenProvider - OAuth2 token provider interface.
 * Provides base64 encoded OAuth2 auth strings for SMTP authentication.
 *
 * @see     OAuth
 * @see     SMTP::authenticate()
 *
 * @author  Peter Scopes (pdscopes)
 * @author  Marcus Bointon (Synchro/coolbru) <phpmailer@synchromedia.co.uk>
 */
interface OAuthTokenProvider
{
    /**
     * Generate a base64-encoded OAuth token ensuring that the access token has not expired.
     * The string to be base 64 encoded should be in the form:
     * "user=<user_email_address>\001auth=Bearer <access_token>\001\001"
     *
     * @return string
     */
    public function getOauth64();
}
