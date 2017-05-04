<?php

namespace Cn\Xu42\DlpuNetwork\Service;

use Cn\Xu42\DlpuNetwork\BizImpl\DlpuNetworkBizImpl;
use Cn\Xu42\DlpuNetwork\Exception\SystemException;

class DlpuNetworkService
{
    private $bizImpl = null;

    public function __construct()
    {
        $this->bizImpl = new DlpuNetworkBizImpl();
    }

    /**
     * 获取用户身份令牌
     *
     * @param string $username
     * @param string $password
     * @return string
     * @throws SystemException
     */
    public function getToken($username, $password)
    {
        try {
            return $this->bizImpl->getToken($username, $password);
        } catch (\Throwable $throwable) {
            throw new SystemException($throwable->getMessage(), $throwable->getCode());
        }
    }

    /**
     * 获取配置信息
     *
     * @param string $token
     * @return string
     * @throws SystemException
     */
    public function query($token)
    {
        try {
            return $this->bizImpl->query($token);
        } catch (\Throwable $throwable) {
            throw new SystemException($throwable->getMessage(), $throwable->getCode());
        }
    }

}
