<?php

namespace App\Observers;

use App\Models\Homework;
use App\Traits\ImageTrait;

class HomeworkObserver
{
    use ImageTrait;

    /**
     * Handle the Homework "created" event.
     *
     * @param  \App\Models\Homework  $homework
     * @return void
     */
    public function created(Homework $homework)
    {
        //
    }

    /**
     * Handle the Homework "updated" event.
     *
     * @param  \App\Models\Homework  $homework
     * @return void
     */
    public function updated(Homework $homework)
    {
        //
    }

    /**
     * Handle the Homework "deleted" event.
     *
     * @param  \App\Models\Homework  $homework
     * @return void
     */
    public function deleted(Homework $homework)
    {
        $deleteImage = $this->deleteImage($homework);
    }

    /**
     * Handle the Homework "restored" event.
     *
     * @param  \App\Models\Homework  $homework
     * @return void
     */
    public function restored(Homework $homework)
    {
        //
    }

    /**
     * Handle the Homework "force deleted" event.
     *
     * @param  \App\Models\Homework  $homework
     * @return void
     */
    public function forceDeleted(Homework $homework)
    {
        //
    }
}
