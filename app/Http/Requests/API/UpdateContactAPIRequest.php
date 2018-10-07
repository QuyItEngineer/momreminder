<?php

namespace App\Http\Requests\API;

use App\Models\Contact;
use InfyOm\Generator\Request\APIRequest;
use Illuminate\Http\Request;

class UpdateContactAPIRequest extends APIRequest
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
    public function rules(Request $request)
    {
        return array_merge(Contact::$rules, [
            'email' => 'required|unique:contacts,id,' . $request->get('id'),
        ]);
    }
}
