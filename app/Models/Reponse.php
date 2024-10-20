<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Reponse extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function structure()
    {
        return $this->belongsTo(Structure::class);
    }

    public static function getReponse($produit_id, $reponse_id, $param)
    {

        $resul = PlanApprovision::where('produit_id', $produit_id)
            ->where('reponse_id', $reponse_id)
            ->get()->first();
        if ($resul != "") {
            return $resul->$param;
        } else {
            return "";
        }
    }

    public static function getAutreReponse($produit_id, $reponse_id, $param)
    {

        $resul = PlanApprovision::where('produit_id', $produit_id)
            ->where('reponse_id', $reponse_id)
            ->get()->first();
        if ($resul != "") {
            return $resul->$param;
        } else {
            return "";
        }
    }

    public static function getStatutPrevision($annee_id, $structure_id)
    {
        $dayDep = Carbon::now()->toDateTime();
        $dayFin = Carbon::now()->toDateTime()->modify('0 day');

        $anneeExercice = AnneeExercice::whereDate('date_debut_prevision', ' <= ', $dayDep)
            ->whereDate('date_fin_prevision', ' >= ', $dayFin)
            ->where('id', $annee_id)->get()->first();
            
            
        
            $reponse = Reponse::where('annee_id', $annee_id)
            ->where('structure_id', $structure_id)
            ->where('type', '=', "prevision")->get()->first();

        if ($anneeExercice != null) {
            if ($reponse != null){
               
                $reponse->update(['ouvert' => 1]);
        
            }else{
                $from_data_prevision = array(
                    'type' => 'prevision',
                    'date_debut' => $anneeExercice->date_debut_prevision,
                    'date_fin' => $anneeExercice->date_fin_prevision,
                    'envoye' => 0,
                    'ouvert' => 1,
                    //'date_reouverture' => '',
                    'structure_id' => $structure_id,
                    'annee_id' => $annee_id,
                );
                Reponse::create($from_data_prevision);

                $from_data_realisation = array(
                    'type' => 'realisation',
                    'date_debut' => $anneeExercice->date_debut_prevision,
                    'date_fin' => $anneeExercice->date_fin_prevision,
                    'envoye' => 0,
                    //'ouvert' => 1,
                    //'date_reouverture' => '',
                    'structure_id' => $structure_id,
                    'annee_id' => $annee_id,
                );
                Reponse::create($from_data_realisation);

                return false;
            }
            return true;
        } else {
            $anneeExercice = AnneeExercice::where('id', $annee_id)->get()->first();
            
            if ($reponse != null) {
                $resul = Reponse::controleReponse($reponse->id);
                return $resul;
            } else {
                $from_data_prevision = array(
                    'type' => 'prevision',
                    'date_debut' => $anneeExercice->date_debut_prevision,
                    'date_fin' => $anneeExercice->date_fin_prevision,
                    //'envoye' => 0,
                    'ouvert' => 0,
                    //'date_reouverture' => '',
                    'structure_id' => $structure_id,
                    'annee_id' => $annee_id,
                );
                Reponse::create($from_data_prevision);

                $from_data_realisation = array(
                    'type' => 'realisation',
                    'date_debut' => $anneeExercice->date_debut_prevision,
                    'date_fin' => $anneeExercice->date_fin_prevision,
                    'envoye' => 0,
                    'ouvert' => 0,
                    //'date_reouverture' => '',
                    'structure_id' => $structure_id,
                    'annee_id' => $annee_id,
                );
                Reponse::create($from_data_realisation);

                return false;
            }
        }
    }

    public static function getStatutRealisation($annee_id, $structure_id)
    {
        
        $dayDep = Carbon::now()->toDateTime();
        $dayFin = Carbon::now()->toDateTime()->modify('0 day');

        $anneeExercice = AnneeExercice::whereDate('date_debut_realisation', ' <= ', $dayDep)
            ->whereDate('date_fin_realisation', ' >= ', $dayFin)
            ->where('id', $annee_id)->get()->first();

        $reponse = Reponse::where('annee_id', $anneeExercice->id)
            ->where('structure_id', $structure_id)
            ->where('type', '=', 'realisation')->get()->first();

           
        if ($anneeExercice != null) {
            
            if ($reponse != null){
               
                $reponse->update(['ouvert' => 1]);
        
            }else{
                $from_data_prevision = array(
                    'type' => 'prevision',
                    'date_debut' => $anneeExercice->date_debut_prevision,
                    'date_fin' => $anneeExercice->date_fin_prevision,
                    'envoye' => 0,
                    //'ouvert' => 1,
                    //'date_reouverture' => '',
                    'structure_id' => $structure_id,
                    'annee_id' => $annee_id,
                );
                Reponse::create($from_data_prevision);

                $from_data_realisation = array(
                    'type' => 'realisation',
                    'date_debut' => $anneeExercice->date_debut_prevision,
                    'date_fin' => $anneeExercice->date_fin_prevision,
                    'envoye' => 0,
                    'ouvert' => 1,
                    //'date_reouverture' => '',
                    'structure_id' => $structure_id,
                    'annee_id' => $annee_id,
                );
                Reponse::create($from_data_realisation);

                return false;
            }
            return true;
        } else {
            

            if ($reponse != null) {
                $resul = Reponse::controleReponse($reponse->id);
                return $resul;
            } else {
                $from_data_prevision = array(
                    'type' => 'prevision',
                    'date_debut' => $anneeExercice->date_debut_prevision,
                    'date_fin' => $anneeExercice->date_fin_prevision,
                    //'envoye' => 0,
                    'ouvert' => 0,
                    //'date_reouverture' => '',
                    'structure_id' => $structure_id,
                    'annee_id' => $annee_id,
                );
                Reponse::create($from_data_prevision);

                $from_data_realisation = array(
                    'type' => 'realisation',
                    'date_debut' => $anneeExercice->date_debut_prevision,
                    'date_fin' => $anneeExercice->date_fin_prevision,
                    'envoye' => 0,
                    'ouvert' => 0,
                    //'date_reouverture' => '',
                    'structure_id' => $structure_id,
                    'annee_id' => $annee_id,
                );
                Reponse::create($from_data_realisation);

                return false;
            }
        }
    }

    public static function controleReponse($reponse_id)
    {
        $dayDep = Carbon::now()->toDateTime();
        $dayFin = Carbon::now()->toDateTime()->modify('0 day');

        $reponse = Reponse::where('id', $reponse_id)
            ->whereDate('date_debut', ' <= ', $dayDep)
            ->whereDate('date_fin', ' >= ', $dayFin)
            ->get()->first();

        if ($reponse != null) {
            return true;
        } else {
            $reponse = Reponse::where('id', $reponse_id)
                ->whereDate('date_reouverture', ' >= ', $dayFin)
                ->get()->first();

            if ($reponse != null) {
                if ($reponse->envoye == 0) {
                    return true;
                } else {
                    return false;
                }
            } else {
                Reponse::where('id', $reponse_id)->update(['ouvert' => 0]);
                return false;
            }
        }
    }

    public static function getStatutAnneeActive($structure_id)
    {

        $anneeExercice = AnneeExercice::anneeActive();

        if ($anneeExercice != null) {
            return true;
        } else {
            $reponse = Reponse::where('annee_id', $anneeExercice->id)->get()->first();
        }
    }

    public static function getCorrectionPeriode($structure_id,$option){
        $an = AnneeExercice::where('statut', '=', 'active')->get()->first();

        $reponse = Reponse::where('annee_id', $an->id)->where('structure_id', $structure_id)
                            ->where('type', $option)->get()->first();

        $result = true;
        $duree = AnneeExercice::getDifDate($structure_id,$option);

        if ($duree < 0) {
            $reponse->update(['ouvert' => 0]);
            $result = false;
        }else{
            $reponse->update(['ouvert' => 1]);
        }

        return $result;
    }
}
