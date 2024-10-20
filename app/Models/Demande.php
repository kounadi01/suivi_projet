<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Demande extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // protected $fillable = [
    //     'structure_id',
    //     'annee_id',
    //     'produit_id',
    //     'fichier',
    //     'type',
    //     'montant_total',
    //     'montant_local',
    // ];

    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }
    public function annee()
    {
        return $this->belongsTo(AnneeExercice::class);
    }

    public function structure()
    {
        return $this->belongsTo(Structure::class);
    }
}
