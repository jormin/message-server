## 简介

使用 [Swoole Distributed](http://sd.youwoxing.net/) 开发的留言板服务端，提供如下功能：

### [用户端](https://github.com/jormin/message-frontend)

- 用户注册

    注册时需要填写姓名、手机号、邮箱、性别信息，系统会对手机号和邮箱进行验证码验证。
    
    手机短信使用的是 `阿里云短信` 服务，使用前需要配置阿里云账号信息。
    
    邮件发送使用的是 `Swift Mailer`， 使用前需要配置自己的邮箱账号信息。

- 用户登录\个人信息查看\退出

    支持手机号和邮箱登录，邮箱登录前提是邮箱必须经过验证（点击激活邮件中的链接进行激活）

- 发送留言

    允许用户填写留言标题(80个字符以内) ，留言内容(500个字符以内)，上传一张图片，发送留给给指定用户
    
    上传图片使用的是 `七牛云` 服务，使用前需要配置七牛账号信息
    
    留言时允许用户通过搜索姓名的方式来检索出特定用户
    
- 留言列表
    
    留言列表需要登录后才可查看，分为 `公共留言`、`我发送的留言`、`我收到的留言`

    公共留言为没有接收者的留言
    
- 查看留言、评论列表及发表评论

    允许用户查看留言后发表评论，评论内容限定140个字符以内
    
### [管理端](https://github.com/jormin/message-backend)

- 用户管理
    
    允许管理员查看用户列表，根据姓名、性别、手机号、邮箱、账号状态等进行检索，并允许 `禁用|启用` 用户账号

- 留言管理

    允许管理员查看留言列表，根据姓名、性别、手机号、邮箱、标题等进行检索，并允许删除留言

- 评论管理

    允许管理员查看指定留言的评论列表，并允许删除评论
    
## 文档

- [数据库设计文档](doc/数据库设计文档.md)

- [数据字典文档](doc/数据字典文档.md)
    
## 安装

- 克隆代码

    ```
    git clone git@github.com:jormin/message-server.git
    ```

- 安装扩展

    ```
    composer install -vvv
    ```
    
- 导入数据库

    数据库文件为 `data\message.sql` ,自行在数据库中创建数据库并导入数据文件

- 修改配置

    ```
    # 复制参数配置文件
    cp src/config/params.sample params.php
    
    # 修改参数配置
    vim src/config/params.php
    
    # 修改数据库配置
    vim src/config/mysql.php
    
    # 修改Redis配置
    vim src/config/redis.php
    
    # 修改项目启动配置
    vim src/config/ports.php
    ```

- 启动服务

    ```
    php bin/start_swoole_server.php stary -de
    ```

## 配置项说明

### 七牛云配置

- accessKey: 七牛 Access Key
- secretKey: 七牛 Secret Key
- bucket：图片上传空间
- domain：空间绑定的域名

### 阿里云配置

- accessKeyId: 阿里云 Access Key ID
- accessKeySecret: 阿里云 Access Key Secret
- signature：阿里云短信签名
- registerCode：阿里云注册短信验证码模板编码

### 邮箱配置

- host: 短信服务商邮件网关
- port: 短信服务商邮件端口
- from：发送邮箱
- username：短信服务商账号
- password：短信服务商密码