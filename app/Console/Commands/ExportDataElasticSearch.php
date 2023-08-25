<?php

namespace App\Console\Commands;

use Core\SeedWork\Infra\Contracts\ElasticClientInterface;
use Illuminate\Console\Command;

class ExportDataElasticSearch extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    // php artisan app:export-data-elastic-search mysql-server.fullcycle.categories
    protected $signature = 'app:export-data-elastic-search {index}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Export Data Elastic Search';

    public function __construct(protected ElasticClientInterface $elasticClient)
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $index = $this->argument('index');

        $response = $this->elasticClient->search(['index' => $index]);

        foreach ($response['hits']['hits'] as $item) {
            // Convert the array to a string representation of key-value pairs
            $content = http_build_query($item['_source']['after']);

            // Replace URL-encoded characters with their literal counterparts
            $content = urldecode($content);

            // Remove the URL-encoded equal sign "="
            $content = str_replace('=', ':', $content);
            $content = str_replace('&', ',', $content);

            // Remove numeric array indexes
            $content = preg_replace('/%5B[0-9]+%5D/', '', $content);

            file_put_contents(base_path("tests/dumps/import-{$index}.csv"), PHP_EOL . $content, FILE_APPEND);
        }
    }
}
