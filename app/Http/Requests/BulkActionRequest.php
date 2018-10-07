<?php
/**
 * Created by IntelliJ IDEA.
 * User: vuldh
 * Date: 7/31/18
 * Time: 4:21 PM
 */

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class BulkActionRequest extends FormRequest
{
    const ACTION_ACTIVE = 'active';
    const ACTION_INACTIVE = 'inactive';
    const ACTION_DELETE = 'delete';

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
            'action' => 'required|in:' . join(',', [
                    self::ACTION_ACTIVE,
                    self::ACTION_INACTIVE,
                    self::ACTION_DELETE
                ]),
            'ids' => 'required|array|min:1'
        ];
    }
}