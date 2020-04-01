<?php

namespace App\Http\Controllers;

use App\Enquirer;
use App\Http\Requests\HelpSearchRequest;
use App\Http\Resources\EnquirerResource;
use App\Jobs\SearchForHelpers;

class HelpSearchController extends Controller
{
    /**
     * @param  HelpSearchRequest  $request
     *
     * @return EnquirerResource
     * @throws \Exception
     */
    public function __invoke(HelpSearchRequest $request)
    {
        try {
            \DB::beginTransaction();

            $enquirer = Enquirer::create($request->validated());

            $this->dispatch(new SearchForHelpers($enquirer));

            \DB::commit();

            return new EnquirerResource($enquirer);
        } catch (\Exception $exception) {
            \DB::rollBack();

            throw $exception;
        }
    }
}
