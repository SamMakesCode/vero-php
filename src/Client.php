<?php

namespace SamLittler\Vero;

class Client extends \GuzzleHttp\Client
{
    private $authToken = null;

    public function __construct(string $authToken, array $config = [])
    {
        $this->authToken = $authToken;

        parent::__construct($config);
    }

    public function getAuthToken() : string
    {
        return $this->authToken;
    }
}
