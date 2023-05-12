# OutputMessage 标准对照表

| 序号  | output内容                | HTTP状态码 | 中文解释                            |
|-----|-------------------------|---------|---------------------------------|
| 100 | SessionError            | 502     | 通讯密钥错误                          |
| 200 | Success                 | 200     | 操作成功                            |
| 201 | SuccessButEmail         | 200     | 操作成功但邮件发送失败                     |
| 300 | SqlInsertFail           | 400     | 数据表内容插入失败                       |
| 301 | SqlSelectFail           | 400     | 数据表内容查询失败                       |
| 302 | SqlUpdateFail           | 400     | 数据表内容修改失败                       |
| 303 | SqlDeleteFail           | 400     | 数据表内容删除失败                       |
| 310 | TokenTooShort           | 502     | Token长度过短                       |
| 311 | TokenTooLong            | 502     | Token长度过长                       |
| 400 | usernameFormat          | 405     | 用户名格式不符合 （格式允许0-9,A-Z,a-z及_）    |
| 401 | emailFormat             | 405     | 邮箱格式不符合                         |
| 402 | userFormat              | 405     | 用户格式不符合                         |
| 403 | passwordIncorrect       | 403     | 密码不正确                           |
| 404 | typeFormat              | 403     | 类型不正确                           |
| 405 | blog_nameFormat         | 403     | 博客名字格式不符合（格式允许0-9,A-Z,a-z,_及中文） |
| 406 | blog_introduceFormat    | 403     | 博客描述格式不符合（格式允许0-9,A-Z,a-z,_及中文） |
| 407 | internetFormat          | 403     | 地址格式错误                          |
| 408 | booleanFormat           | 403     | 布尔值格式错误                         |
| 409 | blog_hostFormat         | 403     | 主机格式不符合（格式允许0-9,A-Z,a-z,_及中文）   |
| 410 | blog_location           | 403     | 添加位置错误                          |
| 500 | CaptchaEffective        | 200     | 激活码任然有效                         |
| 501 | ParameterLack           | 403     | 参数缺失                            |
| 600 | AlReadyUser             | 403     | 已经有这个用户                         |
| 601 | NoUser                  | 403     | 没有这个用户                          |
| 700 | ConsolePermissionDenied | 403     | 后端权限拒绝                          |
| 701 | AdminPermissionDenied   | 403     | 管理员权限拒绝                         |
| 702 | UserPermissionDenied    | 403     | 用户权限拒绝                          |
| 703 | PermissionDenied        | 403     | 权限拒绝                            |
| 800 | CodeRepeat              | 403     | 序号重复，拒绝定义此序号                    |
| 999 |                         |         | （自定义默认输出模块 CustomOutput模块）      |