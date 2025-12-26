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

namespace think\sesclient\driver;

use think\sesclient\Platform;
use TencentCloud\Common\Credential;
use TencentCloud\Ses\V20201002\SesClient;
use TencentCloud\Ses\V20201002\Models\SendEmailRequest;

class TencentCloud extends Platform
{
	/**
     * 平台句柄
     * @var SesClient
     */
    protected $handler;

	/**
     * 平台配置参数
     * @var array
     */
    protected $options = [
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
    ];

    /**
     * 创建句柄
     * @access protected
     * @return $this
     */
    protected function makeHandler()
    {
        // 实例化授权对象
        $credential = new Credential($this->options['secret_id'], $this->options['secret_key']);
        // 服务接入点
        $endpoint = $this->options['endpoint'];
        // 如果为空
        if(empty($endpoint)){
            // 默认使用广州
            $endpoint = 'ap-guangzhou';
        }
        // 实例化要请求产品的 client 对象
        $this->handler = new SesClient($credential, $endpoint);
        // 返回
        return $this;
    }

	/**
     * 发送邮件
     * @access public
     * @param string|array $emails
     * @param string $subject
     * @param array $data
     * @return array
     */
    public function send($emails, $subject, array $data = [])
	{
        // 如果指定的邮件地址不是数组
        if(!is_array($emails)){
            $emails = explode(',', $emails);
        }

        // 获取模板ID
        $templateId = $this->options['template_id'];
        // 构造模板数据
        $templateData = json_encode($data, JSON_UNESCAPED_UNICODE);

		// 请求对象
		$request = new SendEmailRequest();

		// 填充请求参数,这里request对象的成员变量即对应接口的入参
		// 发送邮件的邮箱号
		$request->FromEmailAddress = $this->options['from_email'];
		// 邮件主题
		$request->Subject = $subject;
		// 接收邮件的邮箱号列表
		$request->Destination = $emails;
        // 如果有回复邮箱
        if(!empty($this->options['reply_to'])){
            // 设置回复邮箱
            $request->ReplyToAddresses = $this->options['reply_to'];
        }

		// 模板参数
		$request->Template = [
            'TemplateID' => $templateId,
            'TemplateData' => $templateData,
        ];
		
        try{
            // 发起请求
            $response = $this->handler->SendEmail($request);
        } catch (\Exception $e) {
            // 返回错误
            return [null, $e];
        }

        // 如果存在错误信息
        if(isset($response->Error)){
            // 返回错误信息
            return [null, new \Exception($response->Error->Message)];
        }

        // 返回成功
        return [[
            'request_id' => $response->RequestId,
            'message_id' => $response->MessageId,
        ], null];
	}
}