<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NatureProjet extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function projets()
    {
        return $this->hasMany(Projet::class);
    }
}
