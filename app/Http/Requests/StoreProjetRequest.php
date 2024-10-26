<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjetRequest extends FormRequest
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
            'libelle' => 'required|string',
            'description' => 'required|string',
            'quantite_total' => 'required|numeric',
            'montant_total' => 'required|integer',
            'localisation' => 'required|string',
            'date_demarrage' => 'required|date',
            'date_fin_probable' => 'required|date|after_or_equal:date_demarrage',
            'categorie' => 'required|string',
            'taux_physique' => 'required|numeric',
            'taux_financier' => 'required|numeric',
            'statut' => 'required|string',
            'unite' => 'required|string',
            'idSoc' => 'required|integer',
            'idNat' => 'required|integer',
            'idBai' => 'required|integer',
            'idEntr' => 'required|integer',
            'composantes' => 'required|array',
            'coordonnateur' => 'required|integer',
        ];
    }
}
