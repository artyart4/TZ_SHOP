<?php

namespace App\Providers;

use App\Contracts\RouteRegistrar;
use App\Routing\AppRegistrar;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\RateLimiter;
use RuntimeException;
use vendor\src\Domain\Auth\Routing\AuthRegistrar;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     *
     * @return void
     */

    protected array $registrars = [
      AppRegistrar::class,
        AuthRegistrar::class
    ];
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function (Registrar $router){
            $this->mapRoutes($router, $this->registrars);
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
        RateLimiter::for('global', function (Request $request) {
            return Limit::perMinute(500)->by($request->user()?->id ?: $request->ip())->response(function (Request $request, array$headers){
                return response('take it easy',Response::HTTP_TOO_MANY_REQUESTS, $headers);
            });
        });
    }

    protected function mapRoutes(Registrar $router, array $registrars): void
    {
        foreach ($registrars as $registrar) {
            if (! class_exists($registrar) || ! is_subclass_of($registrar, RouteRegistrar::class)) {
                throw new RuntimeException(sprintf(
                    'Cannot map routes \'%s\', it is not a valid routes class',
                    $registrar
                ));
            }

            (new $registrar)->map($router);
        }
    }
}
