<?php

namespace App\Http\Controllers;

use App\Models\AnneeExercice;
use App\Models\Fournisseur;
use App\Models\Photo;
use App\Models\Prevision;
use App\Models\Produit;
use App\Models\Programme;
use App\Models\Realisation;
use App\Models\Region;
use App\Models\Reponse;
use App\Models\SousIndicateur;
use App\Models\Structure;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Khill\Lavacharts\Lavacharts;

class HomeController extends Controller
{
    public function index($annee_id = null)
    {
        //structure de l'utilisateur connecté
        $structure_user = Auth()->user()->structure->id;
        $profil_user = Auth()->user()->profil->nom;

        //Année en cours
        $anneeExercice_encour = AnneeExercice::where('statut', 'active')
            //->where('annee_exercice',now()->format('Y'))
            ->first();

        $anneeExercices = AnneeExercice::where('statut', 'active')
            ->orWhere('statut', 'clôturée')
            ->pluck('annee_exercice', 'id');

        $annee_en_cour_id = 0;
        // dd($annee_id);
        if ($annee_id == null) {
            $annee_en_cour_id = $anneeExercice_encour->id;
        } else {
            $annee_en_cour_id = $annee_id;
        }

        //les prévisions de la structure
        $nbPrevisions = $this->getNbPrevisions($annee_en_cour_id, $structure_user);
        $nbRealisations = $this->getNbRealisations($annee_en_cour_id, $structure_user);
        $reponse = Reponse::where('annee_id', $annee_en_cour_id)->where('structure_id', $structure_user)
        ->where('type','=', 'prevision')->get()->first();

        $realisation = Reponse::where('annee_id', $annee_en_cour_id)->where('structure_id', $structure_user)
        ->where('type','=', 'realisation')->get()->first();


        $data = [
            ['2019', '2020', '2021', '2022', '2023'],
            [48, 40, 19, 86, 27, 90],
            [30, 45, 60, 50, 70, 100]
        ];

        if ($nbPrevisions != null){
            $montant_exterieure = $nbPrevisions->montant_total - $nbPrevisions->montant_local;
            $dataPrevision = [
                ['Projet total', 'Projet terminé'],
                [(int)$nbPrevisions->montant_local, (int)$montant_exterieure],
            ];
        }else{
            $dataPrevision = [
                ['Projet total', 'Projet terminé'],
                [0, 0],
            ];
        }
        
        if ($nbRealisations != null){
            $montant_realisation = $nbRealisations->montant_total - $nbRealisations->montant_local;
            $dataRealisation = [
                ['Projet total', 'Projet en cours'],
                [(int)$nbRealisations->montant_local, (int)$montant_realisation],
            ];
        }else{
            $dataRealisation = [
                ['Projet total', 'Projet en cours'],
                [0, 0],
            ];
        }

        $societes = Structure::where('type_struct','Socité minière')->get()->count();
        $sous_traitants = Structure::where('type_struct','Sous-traitant')->get()->count();
        $fournisseur_locaux = Fournisseur::where('categorie','Locale')->get()->count();
        $fournisseur_etrangers = Fournisseur::where('categorie','Etrangère')->get()->count();
        $produits = Produit::where('type','Bien')->get()->count();
        $services = Produit::where('type','Service')->get()->count();

        $params = [
            'societes' => $societes,'sous_traitants'=>$sous_traitants,'fournisseur_locaux'=>$fournisseur_locaux,
            'fournisseur_etrangers'=>$fournisseur_etrangers,'produits'=>$produits,'services'=>$services
        ];
    

        if ($annee_id == null) {
            return view('dashboard', ["programmes_with_previsions" => [], "anneeExercices" => $anneeExercices,
            'annee_id' => $annee_en_cour_id, "nom_structure" => $structure_user, "nbPrevisions" => $nbPrevisions,
            "nbRealisations" => $nbRealisations, 'data' => $data,'dataprevision' => $dataPrevision,'params'=>$params,
            'datarealisation' => $dataRealisation,'reponse' => $reponse,'realisation'=>$realisation]);
        } else {
            return view('home_statistique', ["programmes_with_previsions" => [], "anneeExercices" => $anneeExercices, 'annee_id' => $annee_id, "nom_structure" => $structure_user, "nbPrevisions" => $nbPrevisions, "nbRealisations" => $nbRealisations, 'data' => $data]);
        }
    }

    public function getNbPrevisions($annee_id, $structure_user)
    {
        if (User::authUserProfil()->nom != 'Administrateur') {
            $prevision = DB::table('reponses')
            ->selectRaw('reponses.annee_id,SUM(plan_approvisions.montant_total) as montant_total,SUM(plan_approvisions.montant_local) as montant_local, COUNT(plan_approvisions.id) as nombre_produit')
            ->join('plan_approvisions', 'plan_approvisions.reponse_id', '=', 'reponses.id')
            ->where('reponses.annee_id', $annee_id)
            // ->where('reponses.envoye','=', true)
            ->where('reponses.structure_id', $structure_user)
            ->groupBy('reponses.annee_id')
            ->get()->first();
        }else{
            $prevision = DB::table('reponses')
            ->selectRaw('reponses.annee_id,SUM(plan_approvisions.montant_total) as montant_total,SUM(plan_approvisions.montant_local) as montant_local, COUNT(plan_approvisions.id) as nombre_produit')
            ->join('plan_approvisions', 'plan_approvisions.reponse_id', '=', 'reponses.id')
            ->where('reponses.annee_id', $annee_id)
            // ->where('reponses.envoye','=', true)
            ->groupBy('reponses.annee_id')
            ->get()->first();
        }
        
        return $prevision;
    }

    public function getNbRealisations($annee_id, $structure_user)
    {

        if (User::authUserProfil()->nom != 'Administrateur') {
            $realisation = DB::table('reponses')
            ->selectRaw('reponses.annee_id,SUM(plan_realisations.montant_total) as montant_total,SUM(plan_realisations.montant_local) as montant_local, COUNT(plan_realisations.id) as nombre_produit')
            ->join('plan_realisations', 'plan_realisations.reponse_id', '=', 'reponses.id')
            ->where('reponses.annee_id', $annee_id)
            // ->where('reponses.envoye','=', true)
            ->where('reponses.structure_id', $structure_user)
            ->groupBy('reponses.annee_id')
            ->get()->first();
        }else{
            $realisation = DB::table('reponses')
            ->selectRaw('reponses.annee_id,SUM(plan_realisations.montant_total) as montant_total,SUM(plan_realisations.montant_local) as montant_local, COUNT(plan_realisations.id) as nombre_produit')
            ->join('plan_realisations', 'plan_realisations.reponse_id', '=', 'reponses.id')
            ->where('reponses.annee_id', $annee_id)
            // ->where('reponses.envoye','=', true)
            ->groupBy('reponses.annee_id')
            ->get()->first();
        }

        return $realisation;
    }

    public function getPrevisionNationale($programme_id, $annee_id, $structure_id)
    {
        $profil_user = Auth()->user()->profil->nom;

        if ($profil_user == "Responsable" || $profil_user == "Administrateur") {
            $previsions = DB::table('previsions')
                ->select(
                    DB::raw('SUM(previsions.effectif_homme_prevu) as total_EH'),
                    DB::raw('SUM(previsions.effectif_femme_prevu) as total_EF'),
                    DB::raw('SUM(previsions.effectif_total_prevu) as total_T'),
                    'sous_indicateurs.id as sous_indicateur_id',
                    'sous_indicateurs.lib_sous_ind as lib_sous_ind',
                    'indicateurs.lib_ind as lib_ind'
                )
                ->join('sous_indicateurs', 'previsions.sous_indicateur_id', '=', 'sous_indicateurs.id')
                ->join('indicateurs', 'sous_indicateurs.indicateur_id', '=', 'indicateurs.id')
                ->join('programmes', 'indicateurs.programme_id', '=', 'programmes.id')
                ->where('previsions.annee_id', $annee_id)
                ->where('programmes.id', $programme_id)
                ->where('previsions.valide_prevu', true)
                ->groupBy('sous_indicateurs.id', 'sous_indicateurs.lib_sous_ind', 'indicateurs.lib_ind')
                ->get();
        } elseif ($profil_user == "Moderateur") {
            $province_user = Auth()->user()->province->id;

            $previsions = DB::table('previsions')
                ->select(
                    DB::raw('SUM(previsions.effectif_homme_prevu) as total_EH'),
                    DB::raw('SUM(previsions.effectif_femme_prevu) as total_EF'),
                    DB::raw('SUM(previsions.effectif_total_prevu) as total_T'),
                    'sous_indicateurs.id as sous_indicateur_id',
                    'sous_indicateurs.lib_sous_ind as lib_sous_ind',
                    'indicateurs.lib_ind as lib_ind'
                )
                ->join('sous_indicateurs', 'previsions.sous_indicateur_id', '=', 'sous_indicateurs.id')
                ->join('indicateurs', 'sous_indicateurs.indicateur_id', '=', 'indicateurs.id')
                ->join('programmes', 'indicateurs.programme_id', '=', 'programmes.id')
                ->join('communes', 'previsions.commune_id', '=', 'communes.id')
                ->join('provinces', 'communes.province_id', '=', 'provinces.id')
                ->where('provinces.id', $province_user)
                ->where('previsions.annee_id', $annee_id)
                ->where('programmes.id', $programme_id)
                ->where('previsions.valide_prevu', true)
                ->groupBy('sous_indicateurs.id', 'sous_indicateurs.lib_sous_ind', 'indicateurs.lib_ind')
                ->get();
        } else {
            $previsions = DB::table('previsions')
                ->select(
                    DB::raw('SUM(previsions.effectif_homme_prevu) as total_EH'),
                    DB::raw('SUM(previsions.effectif_femme_prevu) as total_EF'),
                    DB::raw('SUM(previsions.effectif_total_prevu) as total_T'),
                    'sous_indicateurs.id as sous_indicateur_id',
                    'sous_indicateurs.lib_sous_ind as lib_sous_ind',
                    'indicateurs.lib_ind as lib_ind'
                )
                ->join('sous_indicateurs', 'previsions.sous_indicateur_id', '=', 'sous_indicateurs.id')
                ->join('indicateurs', 'sous_indicateurs.indicateur_id', '=', 'indicateurs.id')
                ->join('programmes', 'indicateurs.programme_id', '=', 'programmes.id')
                ->where('previsions.annee_id', $annee_id)
                ->where('programmes.id', $programme_id)
                ->where('previsions.structure_id', $structure_id)
                ->where('previsions.valide_prevu', true)
                ->groupBy('sous_indicateurs.id', 'sous_indicateurs.lib_sous_ind', 'indicateurs.lib_ind')
                ->get();
        }

        return $previsions;
    }

    public function getRealisationNationale($programme_id, $annee_id, $structure_id)
    {
        $profil_user = Auth()->user()->profil->nom;

        if ($profil_user == "Responsable" || $profil_user == "Administrateur") {
            $realisations = DB::table('realisations')
                ->select(
                    DB::raw('SUM(realisations.effectif_homme_realise) as total_EH'),
                    DB::raw('SUM(realisations.effectif_femme_realise) as total_EF'),
                    DB::raw('SUM(realisations.effectif_total_realise) as total_T'),
                    'sous_indicateurs.id as sous_indicateur_id',
                    'sous_indicateurs.lib_sous_ind as lib_sous_ind',
                    'indicateurs.lib_ind as lib_ind'
                )
                ->join('previsions', 'realisations.prevision_id', '=', 'previsions.id')
                ->join('sous_indicateurs', 'previsions.sous_indicateur_id', '=', 'sous_indicateurs.id')
                ->join('indicateurs', 'sous_indicateurs.indicateur_id', '=', 'indicateurs.id')
                ->join('programmes', 'indicateurs.programme_id', '=', 'programmes.id')
                ->where('previsions.annee_id', $annee_id)
                ->where('programmes.id', $programme_id)
                ->where('realisations.valide_realise', true)
                ->groupBy('sous_indicateurs.id', 'sous_indicateurs.lib_sous_ind', 'indicateurs.lib_ind')
                ->get();
        } elseif ($profil_user == "Moderateur") {
            $province_user = Auth()->user()->province->id;

            $realisations = DB::table('realisations')
                ->select(
                    DB::raw('SUM(realisations.effectif_homme_realise) as total_EH'),
                    DB::raw('SUM(realisations.effectif_femme_realise) as total_EF'),
                    DB::raw('SUM(realisations.effectif_total_realise) as total_T'),
                    'sous_indicateurs.id as sous_indicateur_id',
                    'sous_indicateurs.lib_sous_ind as lib_sous_ind',
                    'indicateurs.lib_ind as lib_ind'
                )
                ->join('previsions', 'realisations.prevision_id', '=', 'previsions.id')
                ->join('sous_indicateurs', 'previsions.sous_indicateur_id', '=', 'sous_indicateurs.id')
                ->join('indicateurs', 'sous_indicateurs.indicateur_id', '=', 'indicateurs.id')
                ->join('programmes', 'indicateurs.programme_id', '=', 'programmes.id')
                ->join('communes', 'previsions.commune_id', '=', 'communes.id')
                ->join('provinces', 'communes.province_id', '=', 'provinces.id')
                ->where('provinces.id', $province_user)
                ->where('previsions.annee_id', $annee_id)
                ->where('programmes.id', $programme_id)
                ->where('realisations.valide_realise', true)
                ->groupBy('sous_indicateurs.id', 'sous_indicateurs.lib_sous_ind', 'indicateurs.lib_ind')
                ->get();
        } else {
            $realisations = DB::table('realisations')
                ->select(
                    DB::raw('SUM(realisations.effectif_homme_realise) as total_EH'),
                    DB::raw('SUM(realisations.effectif_femme_realise) as total_EF'),
                    DB::raw('SUM(realisations.effectif_total_realise) as total_T'),
                    'sous_indicateurs.id as sous_indicateur_id',
                    'sous_indicateurs.lib_sous_ind as lib_sous_ind',
                    'indicateurs.lib_ind as lib_ind'
                )
                ->join('previsions', 'realisations.prevision_id', '=', 'previsions.id')
                ->join('sous_indicateurs', 'previsions.sous_indicateur_id', '=', 'sous_indicateurs.id')
                ->join('indicateurs', 'sous_indicateurs.indicateur_id', '=', 'indicateurs.id')
                ->join('programmes', 'indicateurs.programme_id', '=', 'programmes.id')
                ->where('previsions.annee_id', $annee_id)
                ->where('programmes.id', $programme_id)
                ->where('previsions.structure_id', $structure_id)
                ->where('realisations.valide_realise', true)
                ->groupBy('sous_indicateurs.id', 'sous_indicateurs.lib_sous_ind', 'indicateurs.lib_ind')
                ->get();
        }
        return $realisations;
    }

    public function getGraphePrevision($previsions, $nom_graphe)
    {
        $lava = new Lavacharts;
        $datas = \Lava::DataTable();

        $datas->addStringColumn('nom_indicateur')
            ->addNumberColumn('Effectif Total');

        foreach ($previsions as $prevision) {
            $datas->addRow([$prevision->lib_ind . " => " . $prevision->lib_sous_ind, $prevision->total_T + 0]);
        }

        \LAVA::PieChart($nom_graphe, $datas, [
            'title' => 'Prévisions',
            'largeur' => 400,
            'pieSliceText' => 'valeur'
        ]);
        return $lava;
    }

    public function getGrapheRealisation($realisations, $nom_graphe)
    {
        $lava = new Lavacharts;
        $datas = \Lava::DataTable();

        $datas->addStringColumn('nom_indicateur')
            ->addNumberColumn('Effectif Total');

        foreach ($realisations as $realisation) {
            $datas->addRow([$realisation->lib_ind . " => " . $realisation->lib_sous_ind, $realisation->total_T + 0]);
        }

        \LAVA::PieChart($nom_graphe, $datas, [
            'title' => 'Réalisations',
            'largeur' => 400,
            'pieSliceText' => 'valeur'
        ]);
        return $lava;
    }

    public function acceuil()
    {
        $annee = AnneeExercice::anneeActive();

        if($annee != null){
            $annee_id = $annee->id;
            $san = $annee->annee_exercice;
        }else{
            $annee_id = 0;
            $san = date('Y');
        }
       

       //les previsions en fonction des structures
        $data = DB::table('structures')
            ->selectRaw('structures.id,structures.nom_struct,structures.type_struct,reponses.annee_id,reponses.id as reponse_id, SUM(plan_approvisions.montant_total) as montant_total,SUM(plan_approvisions.montant_local) as montant_local, COUNT(plan_approvisions.id) as nombre_produit')
            ->join('reponses', 'reponses.structure_id', '=', 'structures.id')
            ->join('plan_approvisions', 'plan_approvisions.reponse_id', '=', 'reponses.id')
            ->where('reponses.annee_id', $annee_id)
            ->where('reponses.envoye','=', true)
            ->groupBy('structures.id','structures.nom_struct','structures.type_struct','reponses.annee_id','reponses.id')
            ->get();;
        // dd($data);

        //Prévision totale de l'année
        $prevision = DB::table('reponses')
            ->selectRaw('reponses.annee_id,SUM(plan_approvisions.montant_total) as montant_total,SUM(plan_approvisions.montant_local) as montant_local, COUNT(plan_approvisions.id) as nombre_produit')
            ->join('plan_approvisions', 'plan_approvisions.reponse_id', '=', 'reponses.id')
            ->where('reponses.annee_id', $annee_id)
            ->where('reponses.envoye','=', true)
            ->groupBy('reponses.annee_id')
            ->get()->first();

           // dd( $previsions);
        $photo_max = Photo::where('publier', 1)->orderBy('id', 'DESC')->first();   
        $photos = Photo::where('publier', 1)->orderBy('id', 'DESC')->get();
        // return view('public.index', ["data" =>$data,"annee"=>$san,"prevision"=>$prevision,'photos'=>$photos,'photo_max'=>$photo_max]);
        return view('welcome', ["data" =>$data,"annee"=>$san,"prevision"=>$prevision,'photo_max'=>$photo_max]);
        //return view('public.index', ["data" =>$data,"annee"=>$san,"prevision"=>$prevision,'photo_max'=>$photo_max]);
    }

    public function details($id)
    {

       //les previsions en fonction des structures
        $data = DB::table('produits')
            ->selectRaw('produits.*,plan_approvisions.montant_total,plan_approvisions.id as prevision_id,plan_approvisions.montant_local')
            ->join('plan_approvisions', 'plan_approvisions.produit_id', '=', 'produits.id')
            ->join('reponses', 'reponses.id', '=', 'plan_approvisions.reponse_id')
            ->where('reponses.id', $id)
            ->get();

        // la structure
        $structure = DB::table('structures')
            ->selectRaw('structures.*')
            ->join('reponses', 'reponses.structure_id', '=', 'structures.id')
            ->where('reponses.id', $id)
            ->get()->first();

        return view('details', ["data" =>$data,"structure" =>$structure]);
    }

    public function approvision()
    {

        $annee = AnneeExercice::anneeActive();

        if($annee != null){
            $annee_id = $annee->id;
            $san = $annee->annee_exercice;
        }else{
            $annee_id = 0;
            $san = date('Y');
        }
       

       //les previsions en fonction des structures
        $data = DB::table('structures')
            ->selectRaw('structures.id,structures.nom_struct,structures.type_struct,reponses.annee_id,reponses.id as reponse_id, SUM(plan_approvisions.montant_total) as montant_total,SUM(plan_approvisions.montant_local) as montant_local, COUNT(plan_approvisions.id) as nombre_produit')
            ->join('reponses', 'reponses.structure_id', '=', 'structures.id')
            ->join('plan_approvisions', 'plan_approvisions.reponse_id', '=', 'reponses.id')
            ->where('reponses.annee_id', $annee_id)
            //->where('reponses.envoye','=', true)
            ->groupBy('structures.id','structures.nom_struct','structures.type_struct','reponses.annee_id','reponses.id')
            ->get();;
        // dd($data);

        //Prévision totale de l'année
        $prevision = DB::table('reponses')
            ->selectRaw('reponses.annee_id,SUM(plan_approvisions.montant_total) as montant_total,SUM(plan_approvisions.montant_local) as montant_local, COUNT(plan_approvisions.id) as nombre_produit')
            ->join('plan_approvisions', 'plan_approvisions.reponse_id', '=', 'reponses.id')
            ->where('reponses.annee_id', $annee_id)
            //->where('reponses.envoye','=', true)
            ->groupBy('reponses.annee_id')
            ->get()->first();

           // dd( $previsions);

        return view('approvision', ["data" =>$data,"annee"=>$san,"prevision"=>$prevision]);
    }

    public function societes()
    {

        //Liste des produits
        $data = Structure::where('type_struct','!=','Etat')->get();

        return view('societes', ["data" =>$data]);
    }

}
