<?php

require('vendor/autoload.php');

use App\Controllers\SMSController;
use App\Repositories\SMSRepository;
use App\Services\SMSService;

$smsRepository = new SMSRepository();
$smsService = new SMSService($smsRepository);
$smsController = new SMSController($smsService);

$smsController->createFromFile($argv[1]);

$smsList = $smsController->getAllAsJson();
echo json_encode($smsList);
