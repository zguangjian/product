<?php

namespace App\Observers;

use App\Models\AdminModel;

class AdminObserve
{
    /**
     * Handle the admin "created" event.
     *
     * @param AdminModel $admin
     * @return void
     */
    public function created(AdminModel $admin)
    {
        //\Log::info($admin->account . '-createTime:' . time());
    }

    /**
     * Handle the admin "updated" event.
     *
     * @param AdminModel $admin
     * @return void
     */
    public function updated(AdminModel $admin)
    {
        \Log::info($admin->account . '-updateTime:' . time());
    }

    /**
     * Handle the admin "deleted" event.
     *
     * @param AdminModel $admin
     * @return void
     */
    public function deleted(AdminModel $admin)
    {
        //
    }

    /**
     * Handle the admin "restored" event.
     *
     * @param AdminModel $admin
     * @return void
     */
    public function restored(AdminModel $admin)
    {
        //
    }

    /**
     * Handle the admin "force deleted" event.
     *
     * @param AdminModel $admin
     * @return void
     */
    public function forceDeleted(AdminModel $admin)
    {
        //
    }
}
