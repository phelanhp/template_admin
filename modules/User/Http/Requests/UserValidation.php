<?php

namespace Modules\User\Http\Requests;

use App\AppHelpers\Helper;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserValidation extends FormRequest{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(){
        return TRUE;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(){
        $method = Helper::segment(2);
        if (Helper::segment(1) === 'profile'){
            return [
                'name'              => 'required',
                'email'             => 'required|email|validate_unique:users,' . Auth::guard()
                                                                                     ->id(),
                'password'          => 'min:6|nullable',
                'password_re_enter' => 're_enter_password|required_with:password',
            ];
        }

        switch ($method){
            default:
                return [
                    'name'              => 'required',
                    'email'             => 'required|email|validate_unique:users',
                    'password'          => 'required|min:6',
                    'password_re_enter' => 're_enter_password|required_with:password',
                ];
                break;
            case 'update':
                return [
                    'name'              => 'required',
                    'email'             => 'required|email|validate_unique:users,' . $this->id,
                    'password'          => 'min:6|nullable',
                    'password_re_enter' => 're_enter_password|required_with:password',
                ];
                break;
        }
    }

    public function messages(){
        return [
            'required'          => ':attribute can not be null.',
            'email'             => ':attribute must be the email.',
            'min'               => ':attribute too short',
            're_enter_password' => 'Wrong password',
            'required_with'     => ':attribute can not be null.',
            'validate_unique'   => ':attribute was exist.'
        ];
    }

    public function attributes(){
        return [
            'name'              => 'Name',
            'email'             => 'Email',
            'password'          => 'Password',
            'password_re_enter' => 'Re-enter Password',
            'status'            => 'Status'
        ];
    }
}
