<?php

use App\Models\SMS;
use App\Repositories\SMSRepository;
use PHPUnit\Framework\TestCase;

final class SMSRepositoryTest extends TestCase
{
    private SMSRepository $smsRepository;

    protected function setUp(): void
    {
        $this->smsRepository = new SMSRepository();
        parent::setUp();
    }

    public function testRepositoryCanCreateSMSFromValidData(): void
    {
        $data = [
            '1',
            'REC READ',
            '+5511388382882',
            '22/05/05,16:04:23+08',
            'Mensagem de teste'
        ];

        $this->assertInstanceOf(
            SMS::class,
            $this->smsRepository->createFromArray($data)
        );
    }

    public function testRepositoryCanGetAllSMSAsJson(): void
    {
        $data = [
            '1',
            'REC READ',
            '+5511388382882',
            '22/05/05,16:04:23+08',
            'Mensagem de teste'
        ];

        $this->smsRepository->createFromArray($data);

        $this->assertEquals(
            '[{"seq":1,"status":"REC READ","from":"+5511388382882","timestamp":"22\/05\/05,16:04:23+08","text":"Mensagem de teste"}]',
            $this->smsRepository->getAllAsJson()
        );
    }
}
