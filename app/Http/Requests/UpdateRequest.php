<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        if ($this->input('tags')) {
            $this->merge([
                'tags' => explode(', ', $this->input('tags')),
            ]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'is_active' => ['boolean'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => "Поле для назви статті є обов'язковим для заповнення.",
            'description.required' => "Поле для тексту статті є обов'язковим для заповнення.",
            'title.string' => "Поле для назви статті повинно бути текстом.",
            'description.string' => "Поле для тексту статті повинно бути текстом",            
        ];
    }

}
