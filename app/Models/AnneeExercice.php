<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AnneeExercice extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = 'annee_exercices';

    protected $guarded = ['id'];

    public function demandes()
    {
        return $this->hasMany(Demande::class);
    }

    public static function anneeEnCours()
    {
        $annee = date('Y');
        $an = AnneeExercice::where('annee_exercice', $annee)->get()->first();

        return $an;
    }

    public static function anneeActive()
    {
        $an = AnneeExercice::where('statut', '=', 'active')->get()->first();

        return $an;
    }

    public static function getPeriode($annee_id,$option)
    {
        $an = AnneeExercice::where('id',$annee_id)->get()->first();
        
        if($an != null){
            $debut = "date_debut_".$option;
            $fin = "date_fin_".$option;

            return "Du ".date_format(date_create($an->$debut),"d-m-Y")."     Au     ".date_format(date_create($an->$fin),"d-m-Y");
        }else{
            return "";
        }

        return $an;
    }

    public static function getDifDate($annee_id,$structure_id,$option)
    {
        $an = AnneeExercice::where('id', '=', $annee_id)->get()->first();
        // Date actuelle
        $currentDate = Carbon::now();
        
        if($an != null){
            
            if($option == 'prevision'){
                $targetDate = Carbon::create($an->date_fin_prevision); 
                $daysDifference =  $currentDate->diffInDays($targetDate, false);
            }else{
                $targetDate = Carbon::create($an->date_fin_realisation); 
                $daysDifference =  $currentDate->diffInDays($targetDate, false);
            }

            if( $daysDifference < 0){
                $reponse = Reponse::where('annee_id', $an->id)->where('structure_id', $structure_id)
                            ->where('type', $option)->get()->first();

                if( $reponse != null){
                    if( $reponse->date_reouverture != null){
                        $targetDate = Carbon::parse($reponse->date_reouverture); 
                        $daysDifference =  $currentDate->diffInDays($targetDate, false);
                    }

                }
            }

            if($daysDifference >= 0){
                if ($currentDate->isBefore($targetDate)) {
                    $daysDifference = $daysDifference + 1;
                } else {
                    $daysDifference = 0;
                }
            }
           
            return $daysDifference;
        }else{
            return "";
        }
    }

    public static function getVerifierPeriode($option)
    {
        $an = AnneeExercice::where('statut', '=', 'active')->get()->first();
        // Date actuelle
        $currentDate = Carbon::now();
        $result = false;
        if($an != null){
            
            if($option == 'prevision'){
                $startDate = Carbon::create($an->date_debut_prevision); 
                $endDate = Carbon::create($an->date_fin_prevision); 
            }else{
                $startDate = Carbon::create($an->date_debut_realisation); 
                $endDate = Carbon::create($an->date_fin_realisation); 
            }

            $result =  $currentDate->between($startDate, $endDate);
        }

        return $result;
    }

    public static function getVerifDateDebut($annee_id,$option)
    {
        $an = AnneeExercice::where('id', '=', $annee_id)->get()->first();
        // Date actuelle
        $currentDate = Carbon::now();

        $result = false;
        
        if($an != null){
            
            if($option == 'prevision'){
                $targetDate = Carbon::create($an->date_debut_prevision); 
                $daysDifference =  $currentDate->diffInDays($targetDate, false);
            }else{
                $targetDate = Carbon::create($an->date_debut_realisation); 
                $daysDifference =  $currentDate->diffInDays($targetDate, false);
            }

            if( $daysDifference <= 0){
                $result = true;
            }
        }
        return $result;
    }

    public function projets()
    {
        return $this->hasMany(Projet::class);
    }
}
