<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        return [
            'nombre' => 'min:3|max:60|required',
            'email' => 'required|email|max:40',
            'password' => 'required|min:3|max:30',
            'roll' => 'required',
            'foto' => 'nullable|mimes:png,jpg,jpeg',
        ];
    }

    public function messages()
    {
        return [
            'nombre.min'=> 'El Nombre debe contener como mínimo 3 letras',
            'nombre.max'=> 'El Nombre debe contener como máximo 60 letras',
            'nombre.required' => 'El nombre es requerido',
            'email.max'=> 'El email debe contener como máximo 40 letras',
            'email.email'=> 'El email no tiene un formato valido',
            'email.required'=> 'El email es requerido',
            'password.min' => 'El password debe contener como mínimo 3 letras',
            'password.max' => 'El password debe contener como máximo 30 letras',
            'password.required' => 'El campo password es requerido',
            'roll.required' => 'El campo roll es requerido',
            'foto.mimes' => 'Solo se permiten archivos png, jpeg y jpeg',
        ];
    }
}
