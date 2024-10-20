<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanRealisation extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public static function getMontant($prevision_id, $option)
    {

        $resul = PlanRealisation::where('plan_approvision_id', $prevision_id)
            ->get()->first();
        if ($resul != "") {
            return $resul->$option;
        } else {
            return "";
        }
    }

    public static function getAppreciation($quota_fixe, $quota_realise)
    {

        if ($quota_realise >= $quota_fixe) {
            return "Oui";
        } else {
            return "Non";
        }
    }
}
