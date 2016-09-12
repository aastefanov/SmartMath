<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
        switch ($this->method()) {
            case 'GET':
            case 'DELETE': {
                return [];
            }
            case 'POST': {
                return [
                    'name' => 'required|max:255',
                    'email' => 'required|email|max:255|unique:users',
                    'password' => 'required|min:6|confirmed',
                    'is_admin' => 'boolean'
                ];
            }
            case 'PUT':
            case 'PATCH': {
                return [
                    'name' => 'required|max:255',
                    'email' => 'required|email|max:255',
                    'password' => 'min:6|confirmed',
                    'is_admin' => 'boolean'

                ];
            }
            default:
                return [];
                break;
        }

    }
}
