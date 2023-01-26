<?php

namespace App\Http\Requests\Api\v1;

use App\Http\Requests\BaseRequest;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;

class CreateProductRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $store_id     = (int) request()->store_id;
        $owner_stores = \Auth::user()->stores()->pluck('id')->toArray();
        return (bool) in_array($store_id, $owner_stores);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        Request::merge([
            'slug' => convert_to_slug_string($this->input('name')),
        ]);

        return [
            'store_id'    => 'required|integer',
            'categories'  => 'required|array',
            'name'        => 'required|unique:products|max:255',
            'active'      => 'required',
            'image'       => 'mimes:jpg,png,jpeg,gif'
        ];
    }

    /**
     * Handle a failed authorization attempt.
     *
     * @return void
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    protected function failedAuthorization()
    {
        throw new AuthorizationException('You do not have access to this Store, please create your own and try again');
    }
}
