<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TrackRequest extends FormRequest
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
            'rsn'   =>  [
                'required',
                'min:1',
                'max: 12',
                function($attribute, $value, $fail) {
                    if((bool) preg_match('/^[a-z0-9\-_ ]{1,12}$/i', $value) === false) {
                        $fail("Invalid RSN");
                    }
                }
            ],
            'game'  =>  [
                'required',
                Rule::in([
                    'os',
                    'rs3'
                ])
            ]
        ];
    }
}
