<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider {

    /**
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     *
     * @return void
     */
    public function boot() {
        $this->configureRateLimiting();

        $this->routes(function () {
            $this->apiRoute();
            $this->webRoute();
            $this->artistRoute();
            $this->albumRoute();
            $this->songRoute();
        });
    }

    /**
     * Configure Api route.
     *
     * @return void
     */
    protected function apiRoute() {
        Route::middleware('api')->group(base_path('routes/api.php'));
    }

    /**
     * Configure Web route.
     *
     * @return void
     */
    protected function webRoute() {
        Route::middleware('web')->group(base_path('routes/web.php'));
    }

    /**
     * Configure Artist route.
     *
     * @return void
     */
    protected function artistRoute() {
        Route::middleware('artist')->group(base_path('routes/artist.php'));
    }

    /**
     * Configure Artist route.
     *
     * @return void
     */
    protected function albumRoute() {
        Route::middleware('album')->group(base_path('routes/album.php'));
    }

    /**
     * Configure song route.
     *
     * @return void
     */
    protected function songRoute() {
        Route::middleware('song')->group(base_path('routes/song.php'));
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting() {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }

}
