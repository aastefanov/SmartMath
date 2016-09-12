<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProblemRequest extends FormRequest
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
                    'name' => 'required|unique:categories|min:6',
                    'description' => 'required|min:15'
                ];
            }
            case 'PUT':
            case 'PATCH': {
                return [
                    'name' => 'required|min:6',
                    'description' => 'required|min:15'
                ];
            }
            default:
                return [];
                break;
        }

    }
}
