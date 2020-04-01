<?php

namespace App\Http\Requests;

use App\Category;
use App\Time;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePersonRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'categories.*' => ['required', Rule::in(Category::all()->pluck('id'))],
            'times.*' => ['required', Rule::in(Time::all()->pluck('id'))],
            'last_name' => 'required|max:255',
            'first_name' => 'required|max:255',
            'address' => 'required|max:255',
            'zip' => 'required|max:255',
            'place' => 'required|max:255',
            'phone' => 'required|max:255',
        ];
    }
}
