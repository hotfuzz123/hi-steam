<?php

namespace App\Observers;

use App\Models\Tip;
use App\Traits\ImageTrait;

class TipObserver
{
    use ImageTrait;

    /**
     * Handle the Tip "created" event.
     *
     * @param  \App\Models\Tip  $tip
     * @return void
     */
    public function created(Tip $tip)
    {
        //
    }

    /**
     * Handle the Tip "updated" event.
     *
     * @param  \App\Models\Tip  $tip
     * @return void
     */
    public function updated(Tip $tip)
    {
        //
    }

    /**
     * Handle the Tip "deleted" event.
     *
     * @param  \App\Models\Tip  $tip
     * @return void
     */
    public function deleted(Tip $tip)
    {
        $deleteImage = $this->deleteImage($tip);
    }

    /**
     * Handle the Tip "restored" event.
     *
     * @param  \App\Models\Tip  $tip
     * @return void
     */
    public function restored(Tip $tip)
    {
        //
    }

    /**
     * Handle the Tip "force deleted" event.
     *
     * @param  \App\Models\Tip  $tip
     * @return void
     */
    public function forceDeleted(Tip $tip)
    {
        //
    }
}
