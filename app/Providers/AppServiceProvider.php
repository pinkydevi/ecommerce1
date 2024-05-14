<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use DB;
use Illuminate\Pagination\Paginator;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //pagination problem
        Paginator::useBootstrap();

        // learnhunter
        $settings=DB::table('settings')->first();
        view()->share('setting',$settings);
    }
}
