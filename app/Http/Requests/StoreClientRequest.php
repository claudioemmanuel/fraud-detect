<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClientRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'birth_date' => 'required|date',
            'rg' => 'required|string',
            'cpf' => 'required|string',
            'streetName' => 'required|string',
            'buildingNumber' => 'required|string',
            'neighborhood' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'postcode' => 'required|string',
            'profile_photo_path' => 'required',
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function messages()
    {
        return [
            'name.required' => 'O campo nome é obrigatório',
            'birth_date.required' => 'O campo data de nascimento é obrigatório',
            'rg.required' => 'O campo RG é obrigatório',
            'cpf.required' => 'O campo CPF é obrigatório',
            'streetName.required' => 'O campo rua é obrigatório',
            'buildingNumber.required' => 'O campo número é obrigatório',
            'neighborhood.required' => 'O campo bairro é obrigatório',
            'city.required' => 'O campo cidade é obrigatório',
            'state.required' => 'O campo estado é obrigatório',
            'postcode.required' => 'O campo CEP é obrigatório',
            'profile_photo_path.required' => 'O campo foto é obrigatório',
        ];
    }
}
