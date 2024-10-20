<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ListeProduit extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public static function getPourcentage($annee_id, $produit_id, $phase)
    {

        $resul = ListeProduit::where('annee_id', $annee_id)
            ->where('produit_id', $produit_id)
            ->get()->first();
        if ($resul != "") {
            return $resul->$phase;
        } else {
            return "";
        }
    }

    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }
}
