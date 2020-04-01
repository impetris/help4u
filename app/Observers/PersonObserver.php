<?php

namespace App\Observers;

use App\Jobs\UpdateGeocodingOnPerson;
use App\Person;

class PersonObserver
{
    /**
     * Handle the person "created" event.
     *
     * @param  \App\Person  $person
     *
     * @return void
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function created(Person $person)
    {
        dispatch(new UpdateGeocodingOnPerson($person));
    }

    /**
     * Handle the person "updated" event.
     *
     * @param  \App\Person  $person
     *
     * @return void
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function updated(Person $person)
    {
        dispatch(new UpdateGeocodingOnPerson($person));
    }

    /**
     * Handle the person "deleted" event.
     *
     * @param  \App\Person  $person
     * @return void
     */
    public function deleted(Person $person)
    {
        //
    }

    /**
     * Handle the person "restored" event.
     *
     * @param  \App\Person  $person
     * @return void
     */
    public function restored(Person $person)
    {
        //
    }

    /**
     * Handle the person "force deleted" event.
     *
     * @param  \App\Person  $person
     * @return void
     */
    public function forceDeleted(Person $person)
    {
        //
    }
}
