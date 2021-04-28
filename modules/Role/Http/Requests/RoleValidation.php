<?php

namespace Modules\Role\Http\Requests;

use App\AppHelpers\Helper;
use Illuminate\Foundation\Http\FormRequest;

class RoleValidation extends FormRequest
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
        $method = Helper::segment(2);
        switch ($method) {
            default:
                return [
                    'name' => 'required|validate_unique:roles',
                    'status' => 'required',
                ];
                break;
            case 'update':
                return [
                    'name' => 'required|validate_unique:roles,'.$this->id,
                    'status' => 'required',
                ];
                break;
        }
    }

    public function messages()
    {
        return [
            'required' => ':attribute can not be null.',
            'validate_unique' => ':attribute was exist.'
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Role name',
            'status' => 'Status',
            'description' => 'Description',
        ];
    }
}
