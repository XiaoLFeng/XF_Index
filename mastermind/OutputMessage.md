# OutputMessage 标准对照表

| 序号  | output内容         | HTTP状态码 | 中文解释                         |
|-----|------------------|---------|------------------------------|
| 100 | SessionError     | 502     | 通讯密钥错误                       |
| 200 | Success          | 200     | 操作成功                         |
| 201 | SuccessButEmail  | 200     | 操作成功但邮件发送失败                  |
| 300 | SqlInsertFail    | 400     | 数据表内容插入失败                    |
| 310 | TokenTooShort    | 502     | Token长度过短                    |
| 311 | TokenTooLong     | 502     | Token长度过长                    |
| 400 | usernameFormat   | 405     | 用户名格式不符合 （格式允许0-9,A-Z,a-z及_） |
| 401 | emailFormat      | 405     | 邮箱格式不符合                      |
| 500 | CaptchaEffective | 200     | 激活码任然有效                      |
| 600 | AlReadyUser      | 403     | 已经有这个用户                      |
|     |                  |         |                              |
|     |                  |         |                              |