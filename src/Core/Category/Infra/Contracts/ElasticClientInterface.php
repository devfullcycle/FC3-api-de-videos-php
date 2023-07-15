<?php

namespace Core\Category\Infra\Contracts;

interface ElasticClientInterface
{
    public function search(array $params = []);
    public function createIndex(string $name, array $body, bool $refresh = true);
}
