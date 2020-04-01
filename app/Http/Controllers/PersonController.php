<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePersonRequest;
use App\Http\Resources\PersonResource;
use App\Person;
use App\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return PersonResource
     */
    public function store(StorePersonRequest $request)
    {
        $person = Person::make($request->validated());
        $user = $person->user()->make(['email' => $request->email]);
        $person->save();

        event(new Registered($user));

        return new PersonResource($person);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Person  $person
     *
     * @return PersonResource
     */
    public function show(Request $request)
    {
        /** @var User $user */
        $user = $request->user();
        /** @var Person $person */
        $person = $user->person;

        abort_unless($person instanceof Person, 404);

        $user->can('view', $person);

        return new PersonResource($person);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Person  $person
     *
     * @return PersonResource
     */
    public function update(StorePersonRequest $request, Person $person)
    {
        $person->fill($request->validated());
        $person->save();

        $person->categories()->sync($request->categories);
        $person->times()->sync($request->times);

        return new PersonResource($person);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Person  $person
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Person $person)
    {
        //
    }
}
