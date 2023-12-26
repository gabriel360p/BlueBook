<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('update', $this->user);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'password' => 'required|confirmed|min:8',            
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'você deve informar o seu nome',
            'password.required' => 'A senha é obrigatória',
            'password.confirmed' => 'É necessário confirmar a senha',
            'password.min' => 'A senha deve ter no mínimo 8 caracteres',
        ];
    }
}
