<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ModuleRequest extends FormRequest
{
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
        $rules['type'] = ['required', 'integer'];
        if(request()->type == 1)
        {
            $rules['divider_title'] = ['required','string'];
        }else{
            $rules['module_name'] = ['required','string'];
            if(request()->update_id){
                $rules['url'] = ['nullable','string', 'unique:modules,url,'.request()->update_id];
            }else{
                $rules['url'] = ['nullable','string', 'unique:modules,url'];
            }
            $rules['icon_class'] = ['nullable', 'string'];
            $rules['target']     = ['required', 'string'];
        }
        return $rules;
    }
}
