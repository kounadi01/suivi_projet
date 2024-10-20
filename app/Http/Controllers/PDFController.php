<?php

namespace App\Http\Controllers;

use App\Models\AnneeExercice;
use App\Models\Commune;
use App\Models\Province;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class PDFController extends Controller
{
    public function pdfCommune()
    {
        $id = $_GET['idCommune'];
        $annee = $_GET['annee'];
        if ($id != ''){
            $data = Commune::where('id',$id)->get()->first();

            $pdf = PDF::loadView('rapports.myPDFCommune', compact('data','annee'));

            return $pdf->stream('communes.pdf');
        }else{
            //$annee = date('Y');
            $data = DB::table('programmes')
                ->selectRaw('programmes.*,annee_exercices.annee_exercice')
                ->join('indicateurs', 'indicateurs.programme_id', '=', 'programmes.id')
                ->join('sous_indicateurs', 'sous_indicateurs.indicateur_id', '=', 'indicateurs.id')
                ->join('previsions', 'previsions.sous_indicateur_id', '=', 'sous_indicateurs.id')
                ->join('annee_exercices', 'annee_exercices.id', '=', 'previsions.annee_id')
                ->where('annee_exercices.annee_exercice', $annee)
                ->distinct()->get();

            $pdf = PDF::loadView('rapports.myPDF', compact('data','annee'));

            return $pdf->stream('communes.pdf');
        }
    }

    public function pdfCommuneg()
    {
        $annee = $_GET['annee'];
        $an = AnneeExercice::where('annee_exercice',$annee)->get()->first();
        $data = DB::table('communes')
            ->select('communes.id','communes.nom_commune')
            ->join('previsions', 'previsions.commune_id', '=', 'communes.id')
            ->where('previsions.annee_id',$an->id)
            ->groupBy('communes.id','communes.nom_commune')
            ->get();
        //dd($data);
        $pdf = PDF::loadView('rapports.commune-general',compact('data','annee'));

        return $pdf->stream('communes.pdf');
        //return $pdf->download('itsolutionstuff.pdf');
    }

    public function pdfProvince()
    {
        $id = $_GET['idProvince'];
        $annee = $_GET['annee'];
        if ($id != ''){
            $data = Province::where('id',$id)->get()->first();

            $pdf = PDF::loadView('rapports.myPDFProvince', compact('data','annee'));

            return $pdf->stream('provinces.pdf');
        }else{
            //$annee = date('Y');
            $data = DB::table('programmes')
                ->selectRaw('programmes.*,annee_exercices.annee_exercice')
                ->join('indicateurs', 'indicateurs.programme_id', '=', 'programmes.id')
                ->join('sous_indicateurs', 'sous_indicateurs.indicateur_id', '=', 'indicateurs.id')
                ->join('previsions', 'previsions.sous_indicateur_id', '=', 'sous_indicateurs.id')
                ->join('annee_exercices', 'annee_exercices.id', '=', 'previsions.annee_id')
                ->where('annee_exercices.annee_exercice', $annee)
                ->distinct()->get();

            $pdf = PDF::loadView('rapports.myPDF', compact('data','annee'));

            return $pdf->stream('communes.pdf');
        }
    }

    public function pdfProvinceg()
    {
        $annee = $_GET['annee'];
        $an = AnneeExercice::where('annee_exercice',$annee)->get()->first();
        $data = DB::table('provinces')
            ->select('provinces.id','provinces.nom_province')
            ->join('communes', 'communes.province_id', '=', 'provinces.id')
            ->join('previsions', 'previsions.commune_id', '=', 'communes.id')
            ->where('previsions.annee_id',$an->id)
            ->groupBy('provinces.id','provinces.nom_province')
            ->get();
        //dd($data);
        $pdf = PDF::loadView('rapports.province-general',compact('data','annee'));

        return $pdf->stream('provinces.pdf');
        //return $pdf->download('itsolutionstuff.pdf');
    }

    public function pdfRegion()
    {
        $id = $_GET['idRegion'];
        $annee = $_GET['annee'];
        if ($id != ''){
            $data = Region::where('id',$id)->get()->first();

            $pdf = PDF::loadView('rapports.myPDFRegion', compact('data','annee'));

            return $pdf->stream('regions.pdf');
        }else{
            //$annee = date('Y');
            $data = DB::table('programmes')
                ->selectRaw('programmes.*,annee_exercices.annee_exercice')
                ->join('indicateurs', 'indicateurs.programme_id', '=', 'programmes.id')
                ->join('sous_indicateurs', 'sous_indicateurs.indicateur_id', '=', 'indicateurs.id')
                ->join('previsions', 'previsions.sous_indicateur_id', '=', 'sous_indicateurs.id')
                ->join('annee_exercices', 'annee_exercices.id', '=', 'previsions.annee_id')
                ->where('annee_exercices.annee_exercice', $annee)
                ->distinct()->get();

            $pdf = PDF::loadView('rapports.myPDF', compact('data','annee'));

            return $pdf->stream('communes.pdf');
        }
    }

    public function pdfRegiong()
    {
        $annee = $_GET['annee'];
        $an = AnneeExercice::where('annee_exercice',$annee)->get()->first();
        $data = DB::table('regions')
            ->select('regions.id','regions.nom_region')
            ->join('provinces', 'provinces.region_id', '=', 'regions.id')
            ->join('communes', 'communes.province_id', '=', 'provinces.id')
            ->join('previsions', 'previsions.commune_id', '=', 'communes.id')
            ->where('previsions.annee_id',$an->id)
            ->groupBy('regions.id','regions.nom_region')
            ->get();
        //dd($data);
        $pdf = PDF::loadView('rapports.region-general',compact('data','annee'));

        return $pdf->stream('regions.pdf');
        //return $pdf->download('itsolutionstuff.pdf');
    }
}
