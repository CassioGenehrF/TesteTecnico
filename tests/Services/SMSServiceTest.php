<?php

use App\Models\SMS;
use App\Repositories\SMSRepository;
use App\Services\SMSService;
use PHPUnit\Framework\TestCase;

final class SMSServiceTest extends TestCase
{
    private SMSRepository $smsRepository;
    private SMSService $smsService;
    private string $fileName;
    private string $expectedJson = '[{"seq":1,"status":"REC READ","from":"+5511388382882,","timestamp":"22\/05\/05,16:04:23+08","text":"00480065006C006C006F00200077006F0072006C0064002000C1"},{"seq":2,"status":"REC UNREAD","from":"+5511388382882,","timestamp":"22\/05\/10,13:54:14+08","text":"Essa eh a segunda mensagem"},{"seq":3,"status":"REC UNREAD","from":"+551130872258,","timestamp":"22\/05\/30,19:37:01+08","text":"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam..."}]';

    protected function setUp(): void
    {
        $this->fileName = 'sms-example.txt';
        $this->smsRepository = new SMSRepository();
        $this->smsService = new SMSService($this->smsRepository);
        parent::setUp();
    }

    public function testServiceCanCreateSMSFromFileName(): void
    {
        $this->assertInstanceOf(
            SMS::class,
            $this->smsService->createFromFile($this->fileName)[0]
        );
    }

    public function testServiceCannotCreateSMSFromInvalidFileName(): void
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('File not found');

        $this->smsService->createFromFile('invalid');
    }

    public function testServiceCanGetAllSMSAsJson(): void
    {
        $this->smsService->createFromFile($this->fileName);

        $this->assertEquals(
            $this->expectedJson,
            $this->smsService->getAllAsJson()
        );
    }
}
