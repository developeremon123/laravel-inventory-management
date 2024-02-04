<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class MenuRequest extends FormRequest
{
    /**
     * change error status formvalidation
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'status'=>false,
                'errors'=> $validator->errors()
            ],200)
        );
    }
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        if(request()->update_id){
            $rules['menu_name'] = ['required', 'string', 'unique:menus,menu_name,' . request()->update_id];
        } else {
            $rules['menu_name'] = ['required', 'string', 'unique:menus,menu_name'];
        }
        $rules['deletable'] = ['required', 'integer'];

        return $rules;
    }

}
