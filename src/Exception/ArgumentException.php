<?php

namespace Cn\Xu42\DlpuNetwork\Exception;

class ArgumentException extends BaseException
{
    public $message = '参数格式异常';

    public $code = '42104001';
}
