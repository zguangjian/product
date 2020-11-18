<?php

namespace App\Observers;


use App\Http\Communal\CacheManage;
use App\Http\Services\AdminMenuService;
use Exception;
use App\Models\Menu;
use App\Models\Permissions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class MenuObserver
{

    /**
     * Handle the menu "created" event.
     *
     * @param Menu $menu
     * @return Permissions|bool|Model
     */
    public function created(Menu $menu)
    {
        Log::info('即将新增菜单[' . $menu->id . ']' . $menu->name);
        AdminMenuService::menuCacheClear();
        if ($menu->url != null) {
            return Permissions::create(['mid' => $menu->id, 'name' => $menu->name, 'url' => $menu->url]);
        }
        return true;


    }

    /**
     * Handle the menu "updated" event.
     *
     * @param Menu $menu
     * @return int|void
     * @throws Exception
     */
    public function updated(Menu $menu)
    {
        Log::info('即将updated菜单[' . $menu->id . ']' . $menu->name);
        AdminMenuService::menuCacheClear();
        if ($menu->url == null) {
            Permissions::findOne(['mid' => $menu->id])->delete();
        } else {
            Permissions::findOne(['mid' => $menu->id])->updateOrInsert(['mid' => $menu->id, 'name' => $menu->name, 'url' => $menu->url]);
        }

        return true;
    }

    /**
     * Handle the menu "deleted" event.
     *
     * @param Menu $menu
     * @return bool|void
     * @throws Exception
     */
    public function deleted(Menu $menu)
    {
        Log::info('即将删除菜单[' . $menu->id . ']' . $menu->name);
        AdminMenuService::menuCacheClear();
        return Permissions::findOne(['mid' => $menu->id])->delete();
    }

    /**
     * Handle the menu "restored" event.
     *
     * @param Menu $menu
     */
    public function restored(Menu $menu)
    {
        Log::info('即将恢复菜单[' . $menu->id . ']' . $menu->name);
    }

    /**
     * Handle the menu "force deleted" event.
     *
     * @param Menu $menu
     */
    public function forceDeleted(Menu $menu)
    {
        Log::info('即将强制删除菜单[' . $menu->id . ']' . $menu->name);
    }
}
