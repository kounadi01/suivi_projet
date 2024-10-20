<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePrevisionRequest extends FormRequest
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
            "commune_id"=>"required|numeric",
            "sous_indicateur_id"=>"required|numeric",
            "annee_id"=>"required|numeric",
            //"effectif_total_prevu"=>"required|numeric|min:0",
            "date_debut_prevu"=>"required|date",
            "date_fin_prevu"=>"required|date|after:date_debut_prevu",
            "cout_prevu"=>"required|numeric|min:0",
        ];
    }
}
