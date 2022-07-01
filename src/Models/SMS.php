<?php

namespace App\Models;

use InvalidArgumentException;
use JsonSerializable;

class SMS implements JsonSerializable
{
    private int $seq;
    private string $status;
    private string $from;
    private string $timestamp;
    private string $text;

    private function __construct(array $data)
    {
        if (count($data) != 5) {
            throw new InvalidArgumentException('Data must be exactly 5 elements');
        }

        $this->seq = $data[0];
        $this->status = $data[1];
        $this->from = $data[2];
        $this->timestamp = $data[3];
        $this->text = $data[4];
    }

    public static function fromArray(array $data): self
    {
        return new self($data);
    }

    public function jsonSerialize(): mixed
    {
        return [
            'seq' => $this->seq,
            'status' => $this->status,
            'from' => $this->from,
            'timestamp' => $this->timestamp,
            'text' => $this->text
        ];
    }
}
