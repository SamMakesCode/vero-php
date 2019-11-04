<?php

namespace SamLittler\Vero;

use SamLittler\Vero\Repository\UserRepository;

class Vero
{
    const URL = 'https://api.getvero.com';

    private $client;

    public function __construct(string $auth_token)
    {
        $this->client = new Client($auth_token, [
            'base_uri' => self::URL,
            'headers' => [
                'Accept' => 'application/json',
            ],
        ]);
    }

    public function users() : UserRepository
    {
        return new UserRepository($this->client);
    }
}
