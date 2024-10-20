<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Indicateur;

class CreateSousIndicateurRequest extends FormRequest
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
            'lib_sous_ind' => 'required|unique:sous_indicateurs,lib_sous_ind',
            'programme_id' => 'required',
            'indicateur_id' => 'required',
        ];
    }
}
