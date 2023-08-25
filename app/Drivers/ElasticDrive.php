<?php

namespace App\Drivers;

use Core\SeedWork\Infra\Contracts\ElasticClientInterface;
use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;

class ElasticDrive implements ElasticClientInterface
{
    protected Client $client;

    public function __construct()
    {
        $this->client =  ClientBuilder::create()
            ->setHosts(config('elasticsearch.hosts'))
            ->setBasicAuthentication(
                config('elasticsearch.authentication.username'),
                config('elasticsearch.authentication.password'),
            )->build();

        return $this->client;
    }

    public function search(array $params = [])
    {
        return $this->client->search($params);
    }

    public function createIndex(string $name, array $body, bool $refresh = true)
    {
        $this->client->index([
            'index' => $name,
            'refresh' => $refresh,
            'body' => $body,
        ]);
    }
}
