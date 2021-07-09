<?php

namespace App\Providers;

use App\Cli\SciScraper;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class SciScraperServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(SciScraper::class, function() {
            return new SciScraper(config('sciscraper'));
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}