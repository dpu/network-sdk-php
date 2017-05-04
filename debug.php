<?php

require 'vendor/autoload.php';

$dlpuNetwork = new \Cn\Xu42\DlpuNetwork\Service\DlpuNetworkService();

$token = $dlpuNetwork->getToken('1305040333', 'pass');
var_dump($token);

$config = $dlpuNetwork->query($token);
var_dump($config);

