<?php

namespace Xu42\DlpuNetwork;


/**
 * 大连工业大学校园网自助服务
 * Class DlpuNetwork
 * @package Xu42\DlpuNetwork
 */
class DlpuNetwork
{
    private $username;
    private $password;
    private $cookie;
    private $urlConfig = 'http://210.30.48.36:8080/selfservice/module/webcontent/web/networkdevice_list.jsf';


    /**
     * DlpuNetwork constructor.
     * @param $username
     */
    public function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
        $this->cookie   = $this->getCookie();
    }

    /**
     * 获取配置信息
     * @return array
     */
    public function getConfig()
    {
        if (!$this->cookie) {
            return [];
        }

        $content = $this->myCurl($this->urlConfig);

        $content = iconv("GBK", "UTF-8", $content);

        preg_match_all('/grayBackground">(.*?)</', $content, $matches);

        return $matches[1];
    }


    /**
     * 简单封装的get网络请求助手
     * @return mixed
     */
    private function myCurl($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_COOKIE, $this->cookie);
        $content = curl_exec($ch);
        if (curl_errno($ch)) {
            return null;
        }
        curl_close($ch);
        return $content;
    }


    /**
     * 获取 cookie
     * @return mixed
     */
    public function getCookie()
    {
        $cookie = (new ToolLogin($this->username, $this->password))->getCookie();

        return $cookie;
    }

}
