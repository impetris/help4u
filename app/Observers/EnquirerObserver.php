<?php

namespace App\Observers;

use App\Enquirer;
use App\Jobs\UpdateGeocodingOnEnquirer;

class EnquirerObserver
{
    /**
     * Handle the enquirer "created" event.
     *
     * @param  \App\Enquirer  $enquirer
     *
     * @return void
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function created(Enquirer $enquirer)
    {
        dispatch(new UpdateGeocodingOnEnquirer($enquirer));
    }

    /**
     * Handle the enquirer "updated" event.
     *
     * @param  \App\Enquirer  $enquirer
     *
     * @return void
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function updated(Enquirer $enquirer)
    {
        dispatch(new UpdateGeocodingOnEnquirer($enquirer));
    }

    /**
     * Handle the enquirer "deleted" event.
     *
     * @param  \App\Enquirer  $enquirer
     * @return void
     */
    public function deleted(Enquirer $enquirer)
    {
        //
    }

    /**
     * Handle the enquirer "restored" event.
     *
     * @param  \App\Enquirer  $enquirer
     * @return void
     */
    public function restored(Enquirer $enquirer)
    {
        //
    }

    /**
     * Handle the enquirer "force deleted" event.
     *
     * @param  \App\Enquirer  $enquirer
     * @return void
     */
    public function forceDeleted(Enquirer $enquirer)
    {
        //
    }
}
