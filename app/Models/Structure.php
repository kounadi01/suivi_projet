<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;


class Structure extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $guarded = ['id'];


    public function demandes()
    {
        return $this->hasMany(Demande::class);
    }

    public static function getStructureWithPrevision()
    {

        $structures = DB::table('structures')
            ->select('structures.id', 'structures.nom_struct')
            ->join('previsions', 'previsions.structure_id', '=', 'structures.id')
            ->where('previsions.structure_id', '!=', null)
            ->groupBy('structures.id', 'structures.nom_struct')
            ->get();
        return $structures;
    }

    public static function structure($id)
    {
        $data = Structure::where('id', $id)->get()->first();

        if ($data != '') {
            return $data->nom_struct;
        } else {
            return 'Inconnue';
        }
    }

    public static function structureAuth()
    {
        $id = Auth::user()->getAuthIdentifier();
        $annee = date('Y');

        $structure = DB::table('structures')
            ->select('structures.*')
            ->join('users', 'users.structure_id', '=', 'structures.id')
            ->where('users.id', '=', $id)
            ->get()->first();
        return $structure;
    }
}
