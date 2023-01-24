<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class installCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shop:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'installation';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle():int
    {
        $this->call('storage:link');
        $this->call('migrate');

        return self::SUCCESS;
    }
}
