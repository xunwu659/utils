<?php


namespace services;

class EnterpriseWechatService
{


    public function send($content,$msgtype='')
    {
        try {
            $url = sys_config('enterprise_wechat_url');
            $data = [
                'msgtype' => $msgtype,
                'markdown' => ['content'=>$content],
                'mentioned_mobile_list'=>['@18161705878']

            ];
            HttpService::postRequest($url,json_encode($data));
        } catch (\Throwable $e) {
            Log::error('发送企业群消息失败,失败原因:' . $e->getMessage());
        }
    }

}
