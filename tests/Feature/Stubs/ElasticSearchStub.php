<?php

namespace Tests\Feature\Stubs;

use Core\Category\Infra\Contracts\ElasticClientInterface;

class ElasticSearchStub implements ElasticClientInterface
{
    public function __construct(
        protected array $dataResponse
    ) {
    }

    public function search(array $params = [])
    {
        return $this->dataResponse;
    }
}
