<?php

namespace App\Http\Requests;

use App\Category;
use App\Time;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class HelpSearchRequest extends FormRequest
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
            'category_id' => 'required|exists:categories,id',
            'time_id' => 'required|exists:times,id',
            'email' => 'required|email|max:255',
            'last_name' => 'required|max:255',
            'first_name' => 'required|max:255',
            'address' => 'required|max:255',
            'zip' => 'required|max:255',
            'place' => 'required|max:255',
            'phone' => 'required|max:255',
        ];
    }
}
