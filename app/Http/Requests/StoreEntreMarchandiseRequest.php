<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEntreMarchandiseRequest extends FormRequest
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
            'fournisseur'=>'required|string',
            'motif'=>'required|string',
            'quantite'=>'required|numeric',
            'date_achat'=>'required|date',
            'marchandise_id'=>'required|numeric',
        ];
    }
}
