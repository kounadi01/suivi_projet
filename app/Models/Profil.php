<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profil extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'profils';

    protected $guarded = ['id'];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}