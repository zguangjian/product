<?php

namespace App\Providers;

use App\Models\BaseModel;
use App\Models\Menu;
use App\Models\Permissions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Traits\Macroable;

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
