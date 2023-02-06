<?php

namespace App\Providers;

use App\Faker\FakerImageProvider;
use App\Http\Kernel;
use Carbon\CarbonInterval;
use Faker\Factory;
use Faker\Generator;
use Illuminate\Database\Connection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Generator::class, function(){
            $faker = Factory::create();
            $faker->addProvider(new FakerImageProvider());
            return $faker;
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        Model::preventLazyLoading(!app()->isProduction());
        Model::preventSilentlyDiscardingAttributes(!app()->isProduction());


            //request cycle
            $kernel = app(Kernel::class);
            $kernel->whenRequestLifecycleIsLongerThan(CarbonInterval::second(4), function(){
                logger()->channel('telegram')
                    ->debug('whenRequestLifecycleIsLongerThan' . request()->url());
            });
    }
    }

