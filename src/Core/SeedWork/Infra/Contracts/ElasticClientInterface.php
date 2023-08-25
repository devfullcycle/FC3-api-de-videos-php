<?php

namespace Core\SeedWork\Infra\Contracts;

interface ElasticClientInterface
{
    public function search(array $params = []);
    public function createIndex(string $name, array $body, bool $refresh = true);
}
