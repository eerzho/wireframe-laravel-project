<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    const API_PREFIX    = 'api';
    const API_V1_PREFIX = self::API_PREFIX . '/v1';
    const HOME          = '/';

    private array $integerRoute = [
        'user',
        'role',
    ];

    /**
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        foreach ($this->integerRoute as $item) {
            Route::pattern($item, '[0-9]+');
        }
    }

    /**
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }

    /**
     * @return void
     */
    public function map()
    {
        $this->mapWeb();
        $this->mapApiPrivate();
        $this->mapApiPublic();
        $this->mapAuth();
        $this->mapVerify();
    }

    /**
     * @return void
     */
    public function mapWeb()
    {
        Route::middleware('web')
            ->group(base_path('routes/web.php'));
    }

    /**
     * @return void
     */
    public function mapApiPrivate()
    {
        Route::prefix(self::API_V1_PREFIX)
            ->middleware(['api', 'auth:sanctum'])
            ->group(base_path('routes/api/v1/private/private.php'));
    }

    /**
     * @return void
     */
    public function mapApiPublic()
    {
        Route::prefix(self::API_V1_PREFIX)
            ->middleware('api')
            ->group(base_path('routes/api/v1/public/public.php'));
    }

    /**
     * @return void
     */
    public function mapAuth()
    {
        Route::prefix(self::API_PREFIX . '/auth')
            ->middleware('api')
            ->group(base_path('routes/api/auth.php'));
    }

    /**
     * @return void
     */
    public function mapVerify()
    {
        Route::prefix(self::API_PREFIX . '/verify')
            ->middleware('api')
            ->group(base_path('routes/api/verify.php'));
    }
}
