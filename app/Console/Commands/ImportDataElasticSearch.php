<?php

namespace App\Console\Commands;

use Core\Category\Infra\Contracts\ElasticClientInterface;
use Illuminate\Console\Command;

class ImportDataElasticSearch extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    // php artisan app:import-data-elastic-search mysql-server.fullcycle.categories
    protected $signature = 'app:import-data-elastic-search {index}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import data elastic search';

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

        $fileContents = file(base_path("tests/dumps/import-{$index}.csv"));
        foreach ($fileContents as $line) {
            if ($line === "\n") continue;
            // Split the string into an array based on the delimiter '&'
            $parts = explode(',', $line);

            // Create the key-value pairs from the array
            $content = [];
            foreach ($parts as $part) {
                // Split each part into key and value based on the delimiter ':'
                $pair = explode(':', $part);
                $key = $pair[0];
                $value = str_replace('\n', '', trim($pair[1]));
                $content[$key] = $value;
            }
            $this->elasticClient->createIndex(
                $index,
                ['after' => $content]
            );
        }
    }
}
