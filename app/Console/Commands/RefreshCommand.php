<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class RefreshCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shop:refresh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'refresh db and seeding';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle():int
    {
           if (app()->isProduction()){
               return self::SUCCESS;
           }

        Storage::deleteDirectory('images/products');
        $this->call('migrate:fresh',['--seed'=>true]);
        $this->call('migrate');
        return self::SUCCESS;
    }
}
