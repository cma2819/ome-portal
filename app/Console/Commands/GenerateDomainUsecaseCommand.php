<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use RuntimeException;
use Scripts\GenerateDomainUseCase;

class GenerateDomainUsecaseCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'domain:usecase {name} {--D|domain=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make UseCase for domain layer.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(GenerateDomainUseCase $generate)
    {
        $name = $this->argument('name');
        $domain = $this->option('domain');
        try {
            $generate(__DIR__ . '/../../..', $domain, $name);
        } catch (RuntimeException $e) {
            $this->error($e);
        }
        $this->info('Successful generate usecase files for ' . $domain . '/' . $name . '!');
        return 0;
    }
}
