<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var  string
     */
    public const HOME = '/home';

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var  string|null
     */
    // protected $namespace = 'App\\Http\\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return  void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
//            Route::namespace('App\Http\Controllers\API\Dev')
//                ->group(
//                    function() {
//                        Route::prefix('dev')
//                            ->group(
//                                function () {
//                                        Route::get('faker', function () {
//                                            $class = new Reader(Faker\Generator::class);
//                                            $properties = $class->getParameters()['property'];
//                                            $arr = [];
//                                            foreach ($properties as $property) {
//                                            $arr[] = explode('$', $property)[1];
//                                        }
//                                        return response($arr, Response::HTTP_OK);
//                                    });
//                                }
//                            );
//                    }
//                );
            Route::prefix('api')
                 ->middleware('api')
                 ->namespace('App\Http\Controllers\API')
                 ->group(
                     function (){
                        Route::prefix('v1')
                          ->namespace('V1')
                          ->group(
                              function () {
                                $this->loadRoutesFrom(base_path('routes/api/v1/api.php'));
                              }
                          );
                     }
                 );
            Route::prefix('api')
                ->middleware('api')
                ->namespace('App\Http\Controllers\API')
                ->group(
                    function (){
                        Route::prefix('admin')
                            ->namespace('V1')
                            ->group(
                                function () {
                                    $this->loadRoutesFrom(base_path('routes/api/admin/admin.php'));
                                }
                            );
                    }
                );

            Route::middleware('web')
                 ->namespace($this->namespace)
                 ->group(base_path('routes/web.php'));
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return  void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }
}
