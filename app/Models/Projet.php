<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projet extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function societe()
    {
        return $this->belongsTo(Societe::class, 'idSoc');
    }

    public function entreprise()
    {
        return $this->belongsTo(Fournisseur::class, 'idEntr');
    }

    public function anneeExercice()
    {
        return $this->belongsTo(AnneeExercice::class, 'idAnn');
    }

    public function phase()
    {
        return $this->belongsTo(Phase::class, 'idNat');
    }

    public function realisations()
    {
        return $this->hasMany(Realisation::class, 'idProj');
    }

    public function coordonnateurs()
    {
        return $this->belongsToMany(Coordonateur::class, 'coordonners', 'idProj', 'idCoord')
                    ->withPivot('date_debut', 'date_fin')
                    ->withTimestamps();
    }

    public function composantes()
    {
        return $this->belongsToMany(Composante::class, 'composante_projets', 'idProj', 'idComp')
                    ->withTimestamps();
    }
}
