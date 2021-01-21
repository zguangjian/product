<?php

namespace App\Providers;

use App\Models\AdminModel;
use App\Models\MenuModel;
use App\Observers\AdminObserve;
use App\Observers\MenuObserver;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->EloquentObserveRegister();
    }


    /**
     * 注册model观察者
     */
    private function EloquentObserveRegister()
    {
        AdminModel::observe(AdminObserve::class);
        MenuModel::observe(MenuObserver::class);
    }
}
