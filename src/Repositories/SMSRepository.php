<?php

namespace App\Repositories;

use App\Models\SMS;

class SMSRepository
{
    private array $smsList = [];

    public function createFromArray(array $data): SMS
    {
        $sms = SMS::fromArray($data);
        $this->smsList[] = $sms;

        return $sms;
    }

    public function getAllAsJson(): mixed
    {
        return $this->smsList ? json_encode($this->smsList, JSON_UNESCAPED_UNICODE) : '';
    }
}
