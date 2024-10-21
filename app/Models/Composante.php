<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Composante extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function projets()
    {
        return $this->belongsToMany(Projet::class, 'composante_projets', 'idComp', 'idProj')
                    ->withTimestamps();
    }
}
