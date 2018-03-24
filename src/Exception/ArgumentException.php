<?php

namespace Org\DLPU\Network\Exception;

class ArgumentException extends BaseException
{
    public $message = '参数格式异常';

    public $code = '42104001';
}
