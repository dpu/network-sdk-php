<?php

namespace Xu42\DlpuNetwork;


/**
 * 工具 登陆
 * Class ToolLogin
 * @package Xu42\Qznjw2014
 */
class ToolLogin
{

    private $username = '';
    private $password = '';
    private $urlLogin  = 'http://210.30.48.36:8080/selfservice/module/scgroup/web/login_judge.jsf';


    /**
     * @param $username string 用户名(学号)
     * @param $password string 登陆密码
     */
    public function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
    }


    /**
     * 获取登陆后的Cookie
     * @return mixed String or Bool: 学号密码正确返回Cookie, 否则返回false
     */
    public function getCookie()
    {
        $content = $this->login();
        preg_match_all('/index_self/', $content, $matches);

        (count($matches[0]) != 0) ? ($isSuccess = true) : ($isSuccess = false);
        if ($isSuccess) {
            return $this->reCookie($content);
        } else {
            return false;
        }
    }


    /**
     * 登录 返回网页源代码
     * @return mixed  服务器响应 网页源代码
     */
    private function login()
    {
        $postdata = "name=$this->username&password=$this->password";
        $url = $this->urlLogin;
        return $this->myLoginCurl($url, $postdata);
    }


    /**
     * 一个简单的封装CURL网络请求的函数
     * @param $url        string     请求地址
     * @param $postdata  string     发送的数据
     * @return mixed  网页源代码
     */
    private function myLoginCurl($url, $postdata)
    {
        $headers = array('Content-Length:'.strlen($postdata), 'Referer:'.$this->urlLogin, 'User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.80 Safari/537.36');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $content = curl_exec($ch);
        if (curl_errno($ch)){
            return null;
        }
        curl_close($ch);
        return $content;
    }


    /**
     * 从网页源代码中解析出Cookie信息
     * @param $content string  网页源码
     * @return string Cookie
     */
    private function reCookie($content)
    {
        preg_match('/Set-Cookie:\s(.*?);/', $content, $cookie);
        return trim($cookie[1]);
    }

}
