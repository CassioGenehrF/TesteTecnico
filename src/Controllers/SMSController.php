<?php

namespace App\Controllers;

use App\Models\SMS;
use App\Services\SMSService;
use Exception;

class SMSController
{
    private SMSService $smsService;

    public function __construct(SMSService $smsService)
    {
        $this->smsService = $smsService;
    }

    public function createFromFile(string $fileName): array
    {
        return $this->smsService->createFromFile($fileName);
    }

    public function getAllAsJson(): mixed
    {
        return $this->smsService->getAllAsJson();
    }
}
