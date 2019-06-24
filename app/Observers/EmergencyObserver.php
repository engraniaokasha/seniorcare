<?php

namespace App\Observers;

use App\Emergency;

class EmergencyObserver
{
    /**
     * Handle the emergency "created" event.
     *
     * @param  \App\Emergency  $emergency
     * @return void
     */
    public function created(Emergency $emergency)
    {
        broadcast(new NewMessage($emergency));
    }

    /**
     * Handle the emergency "updated" event.
     *
     * @param  \App\Emergency  $emergency
     * @return void
     */
    public function updated(Emergency $emergency)
    {
        //
    }

    /**
     * Handle the emergency "deleted" event.
     *
     * @param  \App\Emergency  $emergency
     * @return void
     */
    public function deleted(Emergency $emergency)
    {
        //
    }

    /**
     * Handle the emergency "restored" event.
     *
     * @param  \App\Emergency  $emergency
     * @return void
     */
    public function restored(Emergency $emergency)
    {
        //
    }

    /**
     * Handle the emergency "force deleted" event.
     *
     * @param  \App\Emergency  $emergency
     * @return void
     */
    public function forceDeleted(Emergency $emergency)
    {
        //
    }
}
