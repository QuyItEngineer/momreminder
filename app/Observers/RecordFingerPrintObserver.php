<?php

namespace App\Observers;

use Eloquent as Model;

class RecordFingerPrintObserver
{
    /**
     * Handle to the user "created" event.
     *
     * @param  Model  $model
     * @return void
     */
    public function creating(Model $model)
    {
        if(!\Auth::guest()) {
            $model->created_by = \Auth::user()->id;
            $model->updated_by = \Auth::user()->id;
        }
    }

    /**
     * Handle the user "updated" event.
     *
     * @param  Model  $model
     * @return void
     */
    public function updating(Model $model)
    {
        if(!\Auth::guest()) {
            $model->updated_by = \Auth::user()->id;
        }
    }

    /**
     * Handle the user "deleted" event.
     *
     * @param  Model  $model
     * @return void
     */
    public function deleting(Model $model)
    {
        if(!\Auth::guest()) {
            $model->deleted_by = \Auth::user()->id;
        }
    }
}
