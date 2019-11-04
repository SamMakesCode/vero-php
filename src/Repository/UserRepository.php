<?php

namespace SamLittler\Vero\Repository;

use SamLittler\Vero\Model\User;

class UserRepository
{
    private $client;

    public function __construct($client)
    {
        $this->client = $client;
    }

    public function findOrCreate($userId) : User
    {
        return new User($this->client, $userId);
    }
}
