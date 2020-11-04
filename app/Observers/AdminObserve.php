<?php

namespace App\Observers;

use App\Models\Admin;

class AdminObserve
{
    /**
     * Handle the admin "created" event.
     *
     * @param Admin $admin
     * @return void
     */
    public function created(Admin $admin)
    {
        //
    }

    /**
     * Handle the admin "updated" event.
     *
     * @param Admin $admin
     * @return void
     */
    public function updated(Admin $admin)
    {
        //
    }

    /**
     * Handle the admin "deleted" event.
     *
     * @param Admin $admin
     * @return void
     */
    public function deleted(Admin $admin)
    {
        //
    }

    /**
     * Handle the admin "restored" event.
     *
     * @param Admin $admin
     * @return void
     */
    public function restored(Admin $admin)
    {
        //
    }

    /**
     * Handle the admin "force deleted" event.
     *
     * @param Admin $admin
     * @return void
     */
    public function forceDeleted(Admin $admin)
    {
        //
    }
}
