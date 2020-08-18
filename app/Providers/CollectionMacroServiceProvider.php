<?php

namespace App\Providers;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\ServiceProvider;

class CollectionMacroServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
        //注册 更新字段
        Blueprint::macro("timeInteger", function () {
            $this->integer('created_at')->nullable();
            $this->integer('updated_at')->nullable();
        });


    }
}
