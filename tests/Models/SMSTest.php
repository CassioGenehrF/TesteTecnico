<?php

use App\Models\SMS;
use PHPUnit\Framework\TestCase;

final class SMSTest extends TestCase
{
    public function testSMSCanBeCreatedFromValidData(): void
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
            SMS::fromArray($data)
        );
    }

    public function testSMSCannotBeCreatedFromInvalidData(): void
    {
        $this->expectException(InvalidArgumentException::class);

        SMS::fromArray([]);
    }

    public function testCanBeUsedAsJson(): void
    {
        $data = [
            '1',
            'REC READ',
            '+5511388382882',
            '22/05/05,16:04:23+08',
            'Mensagem de teste'
        ];

        $this->assertEquals(
            '{"seq":1,"status":"REC READ","from":"+5511388382882","timestamp":"22\/05\/05,16:04:23+08","text":"Mensagem de teste"}',
            json_encode(SMS::fromArray($data))
        );
    }
}
