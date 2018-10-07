<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Contact;
use Illuminate\Http\Request;

class UpdateContactRequest extends FormRequest
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
     * @param Request $request
     * @return array
     */
    public function rules(Request $request)
    {
        return [
            'email' => 'email|unique:users,id,' . $request->get('id'),
            'member' => 'required',
            'status' => 'required'
        ];
    }
}
