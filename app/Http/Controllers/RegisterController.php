<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePersonRequest;
use App\Http\Resources\PersonResource;
use App\Person;

class RegisterController extends Controller
{
    /**
     * @param  StorePersonRequest  $request
     *
     * @return PersonResource
     * @throws \Exception
     * @throws \Throwable
     */
    public function __invoke(StorePersonRequest $request)
    {
        try {
            \DB::beginTransaction();

            $person = Person::make($request->validated());

            $person->user_id = $request->user()->id;
            $person->type = 'helper';

            $person->save();

            $person->categories()->sync($request->categories);
            $person->times()->sync($request->times);

            \DB::commit();

            return new PersonResource($person);
        } catch (\Exception $exception) {
            \DB::rollBack();

            throw $exception;
        }
    }
}
