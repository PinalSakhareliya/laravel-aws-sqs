<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;


class UserRegistrationMailJobExecution extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'job:userRegistrationMailJobExecution';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send user registration Mail';

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
     * @return mixed
     */
    public function handle()
    {
        config()->set('queue.connections.sqs.retry_after', 660);
        Log::info('Cron start - userRegistrationMailJobExecution');
        $this->call('queue:work', [
            config('queue.default'),
            '--queue' => 'user-registration-mail',
            '--timeout' => 600,
            '--delay' => config('queue.delay'),
            '--tries' => config('queue.tries'),
        ]);
        
        config()->set('queue.connections.sqs.retry_after', 90);
        Log::info('Cron end - userRegistrationMailJobExecution');
    }
}
