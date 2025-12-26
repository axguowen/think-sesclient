# ThinkPHP 邮件推送服务 客户端

一个简单的 ThinkPHP 邮件推送服务 客户端

主要功能：

支持多平台邮件推送配置：目前支持腾讯云平台；

可扩展自定义平台驱动；

支持facade门面方式调用；

支持动态指定模板；

支持动态切换平台；

## 安装

~~~
composer require axguowen/think-sesclient
~~~

## 用法示例

本扩展不能单独使用，依赖ThinkPHP6.0+

首先配置config目录下的sesclient.php配置文件，然后可以按照下面的用法使用。

简单使用

~~~php

use think\facade\SesClient;

// 发送固定内容的模板邮件
SesClient::send('test@receiver.com');
// 发送带参数的模板邮件
SesClient::send('test@receiver.com', ['code' => '486936']);

// 同时发送多个手机号
SesClient::send('test01@receiver.com,test02@receiver.com');
// 支持数组
SesClient::send(['test01@receiver.com', 'test02@receiver.com'], ['code' => '486936']);

~~~

动态切换平台

~~~php

use think\facade\SesClient;

// 使用腾讯云邮件推送平台
SesClient::platform('tencent')->send('test@receiver.com', ['code' => '486936']);

// 动态指定模板
SesClient::platform('tencent', ['template_id' => '新的模板ID'])->send('test@receiver.com', ['code' => '486936']);

~~~

## 配置说明

~~~php

// 邮件推送配置
return [
    // 默认邮件推送平台
    'default' => 'tencent',
    // 邮件推送平台配置
    'platforms' => [
        // 腾讯云
        'tencent' => [
            // 驱动类型
            'type' => 'TencentCloud',
            // 公钥
            'secret_id' => '',
            // 私钥
            'secret_key' => '',
            // 发送邮件的邮箱号
            'from_email' => '',
            // 接收回复的邮箱号
            'reply_to' => '',
            // 模板ID
            'template_id' => '',
            // 服务接入点, 支持的地域列表参考 https://cloud.tencent.com/document/api/382/52071#.E5.9C.B0.E5.9F.9F.E5.88.97.E8.A1.A8
            'endpoint' => '',
        ],
    ],
];

~~~

## 自定义平台驱动

如果需要扩展自定义邮件推送平台驱动，需要实现think\sesclient\PlatformInterface接口

具体代码可以参考现有的平台驱动

扩展自定义驱动后，只需要在邮件推送客户端配置文件sesclient.php中设置default的值为该驱动类名（包含命名空间）即可。