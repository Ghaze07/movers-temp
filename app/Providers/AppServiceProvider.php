<?php

namespace App\Providers;

use App\Services\SMSService;
use App\Services\CUTTLYService;
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
        $this->app->singleton('sms_service', function() {

            $url = config('sms.url');
            $key = config('sms.key');
            $from = config('sms.from');

            return new SMSService($url, $key, $from);
        });

        $this->app->singleton('cuttly_service', function() {

            $url = config('cuttly.url');
            $key = config('cuttly.key');

            return new CUTTLYService($url, $key);
        });

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if( config('app.env') === 'production' ) {
            \URL::forceScheme('https');
        }
    }
}
