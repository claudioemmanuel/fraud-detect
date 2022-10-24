<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSaleRequest extends FormRequest
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
            'client.id' => 'required|integer',
            'client.name' => 'required|string',
            'client.birth_date' => 'required|date',
            'client.rg' => 'required|string',
            'client.cpf' => 'required|string',
            'client.streetName' => 'required|string',
            'client.buildingNumber' => 'required|string',
            'client.neighborhood' => 'required|string',
            'client.city' => 'required|string',
            'client.state' => 'required|string',
            'client.postcode' => 'required|string',
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function messages()
    {
        return [
            'client.id.required' => 'O campo ID do cliente é obrigatório.',
            'client.name.required' => 'O campo nome do cliente é obrigatório.',
            'client.birth_date.required' => 'O campo data de nascimento do cliente é obrigatório.',
            'client.rg.required' => 'O campo RG do cliente é obrigatório.',
            'client.cpf.required' => 'O campo CPF do cliente é obrigatório.',
            'client.streetName.required' => 'O campo nome da rua do cliente é obrigatório.',
            'client.buildingNumber.required' => 'O campo número do imóvel do cliente é obrigatório.',
            'client.neighborhood.required' => 'O campo bairro do cliente é obrigatório.',
            'client.city.required' => 'O campo cidade do cliente é obrigatório.',
            'client.state.required' => 'O campo estado do cliente é obrigatório.',
            'client.postcode.required' => 'O campo CEP do cliente é obrigatório.',
        ];
    }
}
