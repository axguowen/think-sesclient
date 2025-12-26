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

namespace think\sesclient;

/**
 * Platform interface
 */
interface PlatformInterface
{
    /**
     * 发送邮件
     * @access public
     * @param string|array $emails
     * @param string $subject
     * @param array $data
     * @return array
     */
    public function send($emails, $subject, array $data = []);
}
