<?php
/**
 * Created by IntelliJ IDEA.
 * User: vuldh
 * Date: 8/6/18
 * Time: 8:40 PM
 */

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class RecordUploadRequest extends FormRequest
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
            'record_file' => 'required|file'
        ];
    }
}