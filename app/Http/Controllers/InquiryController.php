<?php

namespace App\Http\Controllers;

use App\Http\Resources\InquiryResource;
use App\Inquiry;
use App\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class InquiryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $inquiries = Auth::user()->person->inquiries->whereIn('status', [NULL, 1]);

        return InquiryResource::collection($inquiries);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Inquiry  $Inquiry
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Inquiry $Inquiry)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Inquiry  $Inquiry
     *
     * @return InquiryResource
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, Inquiry $inquiry)
    {
        $request->validate([
            'status' => 'required|in:1,2',
        ]);

        $inquiry->status = $request->status;
        $inquiry->save();

        return new InquiryResource($inquiry);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Inquiry  $Inquiry
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inquiry $Inquiry)
    {
        //
    }
}
