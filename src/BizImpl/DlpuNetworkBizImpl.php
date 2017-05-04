<?php

namespace Cn\Xu42\DlpuNetwork\BizImpl;

use Cn\Xu42\DlpuNetwork\Exception\ArgumentException;
use Cn\Xu42\DlpuNetwork\Exception\SystemException;

class DlpuNetworkBizImpl
{
    const URL_LOGIN = 'http://210.30.48.36:8080/selfservice/module/scgroup/web/login_judge.jsf';
    const URL_CONFIG = 'http://210.30.48.36:8080/selfservice/module/webcontent/web/networkdevice_list.jsf';

    public function getToken($username, $password)
    {
        if (empty($username) || empty($password)) throw new ArgumentException('账号密码不能为空');

        $postData = "name=$username&password=$password";

        $curlResponse = $this->curlRequest(self::URL_LOGIN, $postData);

        preg_match_all('/index_self/', $curlResponse, $matches);

        if (empty($matches[0])) throw new SystemException('账号或密码错误');

        preg_match('/Set-Cookie:\s(.*?);/', $curlResponse, $matches);

        if (empty($matches[1])) throw new SystemException('获取token异常');

        return $matches[1];
    }

    public function query($token)
    {
        if (empty($token)) throw new ArgumentException('token不能为空');

        $curlResponse = $this->curlRequest(self::URL_CONFIG, '', $token);

        preg_match_all('/grayBackground">(.*?)</', iconv("GBK", "UTF-8", $curlResponse), $matches);

        if (empty($matches[1])) throw new SystemException('获取配置信息失败');

        return [
            'ip' => $matches[1][0],
            'mac' => $matches[1][1],
            'area' => $matches[1][3],
            'type' => $matches[1][4],
        ];
    }

    private function curlRequest($url, $postData, $token = '')
    {
        (empty($postData)) ? $isPost = false : $isPost = true;
        $headers = array('Content-Length:' . strlen($postData), 'Referer:' . self::URL_LOGIN, 'User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.80 Safari/537.36');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, $isPost);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_COOKIE, $token);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        $curlResponse = curl_exec($ch);
        if ($curlResponse === false) throw new SystemException('网络请求失败');
        return $curlResponse;
    }

}