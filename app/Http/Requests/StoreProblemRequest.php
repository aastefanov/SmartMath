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
                    'description' => 'required|min:15',
                    'difficulty' => 'integer|required|min:0|max:10',
                    'answer' => 'required',
                    'category_id' => 'required|integer'
                ];
            }
            case 'PUT':
            case 'PATCH': {
                return [
                    'description' => 'required|min:15',
                    'difficulty' => 'integer|required|min:0|max:10',
                    'answer' => 'required',
                    'category_id' => 'required|integer'
                ];
            }
            default:
                return [];
                break;
        }

    }
}
