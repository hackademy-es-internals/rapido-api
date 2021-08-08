<?php

namespace App\Providers;

use App\Http\Resources\AnnouncementCollection;
use Illuminate\Support\ServiceProvider;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\AnnouncementResource;
use App\Http\Resources\CategoryCollection;

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
        AnnouncementResource::withoutWrapping();
        AnnouncementCollection::withoutWrapping();
        CategoryResource::withoutWrapping();
        CategoryCollection::withoutWrapping();
    }
}
