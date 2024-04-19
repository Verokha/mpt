<?php

namespace App\Providers;

use App\Http\Services\client\AuthService;
use App\Http\Services\client\CharacteristicRequestService;
use App\Http\Services\client\PaymentRequestService;
use App\Http\Services\client\StudyRequestService;
use App\Http\Services\panel\RequestPanelService;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(StudyRequestService::class);
        $this->app->bind(CharacteristicRequestService::class);
        $this->app->bind(PaymentRequestService::class);
        $this->app->bind(RequestPanelService::class);
        $this->app->bind(AuthService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        setlocale(LC_TIME, 'ru_RU');
        Carbon::setLocale(config('app.locale'));
    }
}
