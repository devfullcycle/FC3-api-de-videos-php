<?php

namespace App\Drives;

use Core\Category\Infra\Contracts\ElasticClientInterface;
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
}
