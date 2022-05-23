<?php

namespace App\Observers;

use App\Models\Slider;
use App\Traits\ImageTrait;
use Illuminate\Http\Request;

class SliderObserver
{
    use ImageTrait;

    /**
     * Handle the Slider "created" event.
     *
     * @param  \App\Models\Slider  $slider
     * @return void
     */
    public function created(Slider $slider)
    {
        //
    }

    /**
     * Handle the Slider "updated" event.
     *
     * @param  \App\Models\Slider  $slider
     * @return void
     */
    public function updated(Slider $slider)
    {
        //
    }

    /**
     * Handle the Slider "deleted" event.
     *
     * @param  \App\Models\Slider  $slider
     * @return void
     */
    public function deleted(Slider $slider)
    {
        $deleteImage = $this->deleteImage($slider);
    }

    /**
     * Handle the Slider "restored" event.
     *
     * @param  \App\Models\Slider  $slider
     * @return void
     */
    public function restored(Slider $slider)
    {
        //
    }

    /**
     * Handle the Slider "force deleted" event.
     *
     * @param  \App\Models\Slider  $slider
     * @return void
     */
    public function forceDeleted(Slider $slider)
    {
        //
    }
}
