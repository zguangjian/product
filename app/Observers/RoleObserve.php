<?php

namespace App\Observers;

use App\Http\Communal\CacheManage;
use App\Models\RoleModel;

class RoleObserve
{
    /**
     * Handle the role "created" event.
     *
     * @param RoleModel $role
     * @return void
     */
    public function created(RoleModel $role)
    {
        //
    }

    /**
     * Handle the role "updated" event.
     *
     * @param RoleModel $role
     * @return void
     */
    public function updated(RoleModel $role)
    {
        CacheManage::role_permission($role->id)->clearData();
    }

    /**
     * Handle the role "deleted" event.
     *
     * @param RoleModel $role
     * @return void
     */
    public function deleted(RoleModel $role)
    {
        CacheManage::role_permission($role->id)->clearData();
    }

    /**
     * Handle the role "restored" event.
     *
     * @param RoleModel $role
     * @return void
     */
    public function restored(RoleModel $role)
    {
        //
    }

    /**
     * Handle the role "force deleted" event.
     *
     * @param RoleModel $role
     * @return void
     */
    public function forceDeleted(RoleModel $role)
    {
        //
    }
}
