<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class testCronJobs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cronJobs:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Laravel Task Scheduler - CronJobs';

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
    public function handle()
    {
        $this->info(rand(10, 100));
    }
}
