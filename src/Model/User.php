<?php

namespace SamLittler\Vero\Model;

use SamLittler\Vero\Client;

class User
{
    private $channels = [];
    private $client;
    private $email;
    private $userId;

    public function __construct(Client $client, $userId)
    {
        $this->client = $client;
        $this->userId = $userId;
    }

    public function getEmail() : ?string
    {
        return $this->email;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    public function addChannel(string $type, string $address, string $platform) : void
    {
        $this->channels[] = new Channel($type, $address, $platform);
    }

    public function getChannels() : array
    {
        $data = [];
        /** @var Channel $channel */
        foreach ($this->channels as $channel) {
            $data[] = $channel->toArray();
        }
        return $data;
    }

    public function identify(?array $data = null)
    {
        $response = $this->client->post('/api/v2/users/track', [
            'json' => [
                'auth_token' => $this->client->getAuthToken(),
                'id' => $this->userId,
                'email' => $this->getEmail(),
                'data' => $data,
                'channels' => $this->getChannels(),
            ],
        ]);
    }

    public function track(string $eventName, ?array $data = null)
    {
        $response = $this->client->post('/api/v2/events/track', [
            'json' => [
                'auth_token' => $this->client->getAuthToken(),
                'identity' => [
                    'id' => $this->userId,
                    'email' => $this->getEmail(),
                ],
                'data' => $data,
                'event_name' => $eventName,
                'channels' => $this->getChannels(),
            ],
        ]);
    }

    public function unsubscribe()
    {
        $response = $this->client->post('/api/v2/users/unsubscribe', [
            'json' => [
                'auth_token' => $this->client->getAuthToken(),
                'id' => $this->userId,
            ],
        ]);
    }

    public function resubscribe()
    {
        $response = $this->client->post('/api/v2/users/resubscribe', [
            'json' => [
                'auth_token' => $this->client->getAuthToken(),
                'id' => $this->userId,
            ],
        ]);
    }

    public function delete()
    {
        $response = $this->client->post('/api/v2/users/delete', [
            'json' => [
                'auth_token' => $this->client->getAuthToken(),
                'id' => $this->userId,
            ],
        ]);
    }

    public function addTag(string $tagName)
    {
        $response = $this->client->put('/api/v2/users/tags/edit', [
            'json' => [
                'auth_token' => $this->client->getAuthToken(),
                'id' => $this->userId,
                'add' => [$tagName]
            ],
        ]);
    }

    public function removeTag(string $tagName)
    {
        $response = $this->client->put('/api/v2/users/tags/edit', [
            'json' => [
                'auth_token' => $this->client->getAuthToken(),
                'id' => $this->userId,
                'remove' => [$tagName],
            ],
        ]);
    }
}
