<?php

namespace Core\Category\Infra\Contracts;

interface ElasticClientInterface
{
    public function search(array $params = []);
}
