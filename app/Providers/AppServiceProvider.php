<?php

namespace App\Providers;

use App\Cli\SciScraper;
use App\Services\IdUFFSAvatarService;
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
        $this->app->bind(IdUFFSAvatarService::class, function() {
            return new IdUFFSAvatarService(app(SciScraper::class));
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
