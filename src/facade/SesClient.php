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

namespace think\facade;

use think\Facade;

/**
 * @see \think\SesClient
 * @mixin \think\SesClient
 */
class SesClient extends Facade
{
    /**
     * 获取当前Facade对应类名（或者已经绑定的容器对象标识）
     * @access protected
     * @return string
     */
    protected static function getFacadeClass()
    {
        // 返回
        return \think\SesClient::class;
    }
}