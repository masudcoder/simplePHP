<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

// use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\Log;

// DB::listen(function ($query) {
//     Log::info("SQL: " . $query->sql);
//     Log::info("Bindings: " . implode(', ', $query->bindings));
//     Log::info("Time: " . $query->time . ' ms');
// });

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
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
