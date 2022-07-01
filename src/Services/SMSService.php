<?php

namespace App\Services;

use App\Models\SMS;
use App\Repositories\SMSRepository;
use Exception;

class SMSService
{
    const LIST_MESSAGES = 'AT+CMGL="ALL"';
    const END_LIST = 'OK';
    const START_OF_MESSAGE = '+CMGL: ';

    private SMSRepository $smsRepository;

    public function __construct(SMSRepository $smsRepository)
    {
        $this->smsRepository = $smsRepository;
    }

    public function createFromFile(string $fileName): array
    {
        $data = $this->getFileContent($fileName);
        $smsList = [];

        foreach($data as $smsInfo) {
            $sms = $this->smsRepository->createFromArray($smsInfo);
            $smsList[] = $sms;
        }

        return $smsList;
    }

    public function getAllAsJson(): mixed
    {
        return $this->smsRepository->getAllAsJson();
    }

    private function getFileContent(string $fileName): array
    {
        if (!file_exists($fileName)) {
            throw new Exception("File not found");
        }

        $stream = fopen($fileName, 'r');
        $fileContent = [];

        if (trim(fgets($stream)) != self::LIST_MESSAGES) {
            fclose($stream);
            throw new Exception("Informed file is not an AT+CMGL message listing command");
        }

        while (($line = trim(fgets($stream))) !== self::END_LIST) {
            if (str_starts_with($line, self::START_OF_MESSAGE)) {
                $smsInfo = $this->lineToArray($line);
                $smsText = trim(fgets($stream));
                $smsInfo[] = $smsText;

                $fileContent[] = $smsInfo;
            }
        }

        fclose($stream);

        return $fileContent;
    }

    private function lineToArray(string $line): array
    {
        $smsInfo = substr($line, strpos($line, ' ') + 1);
        $smsInfo = str_replace('""', '', $smsInfo);
        $smsInfo = explode(',"', $smsInfo);

        foreach ($smsInfo as $key => $info) {
            $smsInfo[$key] = str_replace('"', '', $info);
        }

        return $smsInfo;
    }
}
