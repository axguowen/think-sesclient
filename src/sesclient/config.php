<?php
// +----------------------------------------------------------------------
// | ThinkPHP SesClient [Simple Email Service Client For ThinkPHP]
// +----------------------------------------------------------------------
// | ThinkPHP 邮件推送客户端
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: axguowen <axguowen@qq.com>
// +----------------------------------------------------------------------

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
