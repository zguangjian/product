<?php

namespace App\Observers;

use App\Http\Communal\CacheManage;
use App\Models\Role;

class RoleObserve
{
    /**
     * Handle the role "created" event.
     *
     * @param Role $role
     * @return void
     */
    public function created(Role $role)
    {
        //
    }

    /**
     * Handle the role "updated" event.
     *
     * @param Role $role
     * @return void
     */
    public function updated(Role $role)
    {
        CacheManage::role_permission($role->id)->clearData();
    }

    /**
     * Handle the role "deleted" event.
     *
     * @param Role $role
     * @return void
     */
    public function deleted(Role $role)
    {
        CacheManage::role_permission($role->id)->clearData();
    }

    /**
     * Handle the role "restored" event.
     *
     * @param Role $role
     * @return void
     */
    public function restored(Role $role)
    {
        //
    }

    /**
     * Handle the role "force deleted" event.
     *
     * @param Role $role
     * @return void
     */
    public function forceDeleted(Role $role)
    {
        //
    }
}
