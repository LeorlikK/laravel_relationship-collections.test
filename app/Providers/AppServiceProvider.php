<?php

namespace App\Providers;

use App\Models\Post;
use App\Services\ServiceClass;
use App\Services\ServiceInterface;
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
        $this->app->bind(ServiceInterface::class, ServiceClass::class);
        $this->app->bind(Post::class, function (){
            return new Post();
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
