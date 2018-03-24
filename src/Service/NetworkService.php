<?php

namespace Org\DLPU\Network\Service;

use Org\DLPU\Network\BizImpl\NetworkBizImpl;
use Org\DLPU\Network\Exception\SystemException;

class NetworkService
{
    private $bizImpl = null;

    public function __construct()
    {
        $this->bizImpl = new NetworkBizImpl();
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
     * @return array
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
