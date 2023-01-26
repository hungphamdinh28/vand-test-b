<?php

namespace App\Http\Requests\Api\v1;

use App\Http\Requests\BaseRequest;
use Illuminate\Http\Request;

class UpdateStoreRequest extends BaseRequest
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
        $id = Request::segment(count(Request::segments()));

        return [
            'name'         => 'required|max:255',
            'legal_name'   => 'max:255',
            'email'        => 'required|email|unique:stores,email,'.$id,
            'active'       => 'required',
            'external_url' => 'nullable|url_valid'
        ];
    }
}
