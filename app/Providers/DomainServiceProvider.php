<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use vendor\src\Domain\Auth\Providers\AuthServiceProvider;

class DomainServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register():void
    {
        $this->app->register(
            AuthServiceProvider::class
        );
    }

}
