<?php

require 'vendor/autoload.php';

$networkService = new \Org\DLPU\Network\Service\NetworkService();

$token = $networkService->getToken('1305040333', 'pass');
var_dump($token);

$config = $networkService->query($token);
var_dump($config);

