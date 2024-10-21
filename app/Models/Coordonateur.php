<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coordonateur extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function projets()
    {
        return $this->belongsToMany(Projet::class, 'coordonners', 'idCoord', 'idProj')
                    ->withPivot('date_debut', 'date_fin')
                    ->withTimestamps();
    }
}
