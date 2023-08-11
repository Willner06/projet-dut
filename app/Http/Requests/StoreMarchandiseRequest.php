<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMarchandiseRequest extends FormRequest
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
            'reference'=>'required|string|unique:marchandises',
            'designation'=>'required|string',
            'prix_unitaire'=>'required|numeric',
            'categorie_id'=>'required|numeric',
            'lieu'=>'required|string',
        ];
    }
}
