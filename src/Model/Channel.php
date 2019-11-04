<?php

namespace SamLittler\Vero\Model;

class Channel
{
    private $type;
    private $address;
    private $platform;

    public function __construct(string $type, string $address, string $platform)
    {
        $this->type = $type;
        $this->address = $address;
        $this->platform = $platform;
    }

    public function toArray() : array
    {
        return [
            'type' => $this->type,
            'address' => $this->address,
            'platform' => $this->platform,
        ];
    }
}
