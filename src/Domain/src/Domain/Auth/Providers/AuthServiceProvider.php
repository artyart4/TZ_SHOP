<?php

namespace Domain\src\Domain\Auth\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use src\Domain\Auth\Providers\ActionsServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
//    public function boot()
//    {
//        $this->registerPolicies();
//
//    }

    public function register():void
    {
      $this->app->register(
          ActionsServiceProvider::class
      );
    }
}
