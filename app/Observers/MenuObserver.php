<?php

namespace App\Observers;


use App\Http\Communal\RedisManage;
use App\Models\Menu;
use App\Models\Permissions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class MenuObserver
{
    public function __construct()
    {
        RedisManage::menu()->clearCacheData();
    }

    /**
     * Handle the menu "created" event.
     *
     * @param Menu $menu
     * @return Permissions|Model
     */
    public function created(Menu $menu)
    {

        return Permissions::create([
            'mid' => $menu->id,
            'name' => $menu->name,
            'url' => $menu->url,
        ]);

    }

    /**
     * Handle the menu "updated" event.
     *
     * @param Menu $menu
     * @return int
     */
    public function updated(Menu $menu)
    {
        RedisManage::menu()->clearCacheData();
        return Permissions::where('mid', $menu->id)->update([
            'name' => $menu->name,
            'url' => $menu->url,
        ]);
    }

    /**
     * Handle the menu "deleted" event.
     *
     * @param Menu $menu
     * @return void
     */
    public function deleted(Menu $menu)
    {
        RedisManage::menu()->clearCacheData();
        return Permissions::where('mid', $menu->id)->delete();
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

    /**
     * @return bool
     */
    private function clearCacheData()
    {
        return RedisManage::menu()->clearCacheData();
    }
}
