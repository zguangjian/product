<?php

namespace App\Observers;


use App\Http\Communal\CacheManage;
use App\Http\Services\AdminMenuService;
use Exception;
use App\Models\MenuModel;
use App\Models\PermissionsModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class MenuObserver
{

    /**
     * Handle the menu "created" event.
     *
     * @param MenuModel $menu
     * @return PermissionsModel|bool|Model
     */
    public function created(MenuModel $menu)
    {
        Log::info('即将新增菜单[' . $menu->id . ']' . $menu->name);
        AdminMenuService::menuCacheClear();
        if ($menu->url != null) {
            return PermissionsModel::create(['mid' => $menu->id, 'name' => $menu->name, 'url' => $menu->url]);
        }
        return true;


    }

    /**
     * Handle the menu "updated" event.
     *
     * @param MenuModel $menu
     * @return int|void
     * @throws Exception
     */
    public function updated(MenuModel $menu)
    {
        Log::info('即将updated菜单[' . $menu->id . ']' . $menu->name);
        AdminMenuService::menuCacheClear();
        if ($menu->url == null) {
            PermissionsModel::findOne(['mid' => $menu->id])->delete();
        } else {
            PermissionsModel::findOne(['mid' => $menu->id])->updateOrInsert(['mid' => $menu->id, 'name' => $menu->name, 'url' => $menu->url]);
        }

        return true;
    }

    /**
     * Handle the menu "deleted" event.
     *
     * @param MenuModel $menu
     * @return bool|void
     * @throws Exception
     */
    public function deleted(MenuModel $menu)
    {
        Log::info('即将删除菜单[' . $menu->id . ']' . $menu->name);
        AdminMenuService::menuCacheClear();
        return PermissionsModel::findOne(['mid' => $menu->id])->delete();
    }

    /**
     * Handle the menu "restored" event.
     *
     * @param MenuModel $menu
     */
    public function restored(MenuModel $menu)
    {
        Log::info('即将恢复菜单[' . $menu->id . ']' . $menu->name);
    }

    /**
     * Handle the menu "force deleted" event.
     *
     * @param MenuModel $menu
     */
    public function forceDeleted(MenuModel $menu)
    {
        Log::info('即将强制删除菜单[' . $menu->id . ']' . $menu->name);
    }
}
