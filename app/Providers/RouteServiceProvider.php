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
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web/web.php'));

            Route::middleware('web')
                ->group(base_path('routes/web/reservation.php'));

            Route::middleware('web')
                ->group(base_path('routes/web/register.php'));

            Route::middleware('web')
                ->group(base_path('routes/web/mypage.php'));

            Route::middleware('web')
                ->group(base_path('routes/web/forgot-password.php'));

            Route::middleware('web')
                ->group(base_path('routes/web/reset-password.php'));

            Route::middleware('web')
                ->group(base_path('routes/web/temporary.php'));

            Route::middleware('web')
                ->group(base_path('routes/web/profile.php'));

            Route::middleware('web')
                ->group(base_path('routes/web/history.php'));

            Route::middleware('web')
                ->group(base_path('routes/web/withdrawal.php'));

            Route::middleware('web')
                ->group(base_path('routes/web/admin/home.php'));

            Route::middleware('web')
                ->group(base_path('routes/web/admin/user.php'));

            Route::middleware('web')
                ->group(base_path('routes/web/admin/reserve.php'));
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
    }
}
