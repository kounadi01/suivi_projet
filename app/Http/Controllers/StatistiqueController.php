<?php

namespace App\Http\Controllers;

use App\Models\AnneeExercice;
use App\Models\Commune;
use App\Models\Departement;
use App\Models\Fournisseur;
use App\Models\Prevision;
use App\Models\Programme;
use App\Models\Province;
use App\Models\Realisation;
use App\Models\Region;
use App\Models\Reponse;
use App\Models\Structure;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Khill\Lavacharts\Lavacharts;



class StatistiqueController extends Controller
{
    public static function getGraphePrevision($previsions, $nom_graphe)
    {

        $lava = new Lavacharts;
        $datas = \Lava::DataTable();

        $datas->addStringColumn('nom_indicateur')
            ->addNumberColumn('Effectif Total Bénéficiaire')
            ->addNumberColumn('Effectif homme bénéficiaire')
            ->addNumberColumn('Effectif femme bénéficiaire');

        foreach ($previsions as $prevision) {
            $datas->addRow([$prevision->lib_ind . "=>" . $prevision->lib_sous_ind, $prevision->total_T, $prevision->total_EH, $prevision->total_EF]);
        }

        \Lava::ColumnChart($nom_graphe, $datas, [
            'title' => 'Prévisions',
            'titleTextStyle' => [
                'color'    => '#eb6b2c',
                'fontSize' => 14
            ],
            'legend' => [
                'position' => 'top'
            ]
        ]);

        return $lava;
    }

    public function getGrapheRealisation($realisations, $nom_graphe)
    {
        $lava = new Lavacharts;
        $datas = \Lava::DataTable();

        $datas->addStringColumn('nom_indicateur')
            ->addNumberColumn('Effectif Total Bénéficiaire')
            ->addNumberColumn('Effectif homme bénéficiaire')
            ->addNumberColumn('Effectif femme bénéficiaire');

        foreach ($realisations as $realisation) {
            $datas->addRow([$realisation->lib_ind . "=>" . $realisation->lib_sous_ind, $realisation->total_T, $realisation->total_EH, $realisation->total_EF]);
        }

        \Lava::ColumnChart($nom_graphe, $datas, [
            'title' => 'Réalisations',
            'titleTextStyle' => [
                'color'    => '#eb6b2c',
                'fontSize' => 14
            ],
            'legend' => [
                'position' => 'top'
            ]
        ]);

        return $lava;
    }

    public function getStatistiqueByCommune($annee_id = null, $structure_id = null, $commune_id = null)
    {
        $communes = Commune::getCommuneWithPrevision()->pluck('nom_commune', 'id');

        $structures = Structure::getStructureWithPrevision()->pluck('nom_struct', 'id');
        $anneeExercices = AnneeExercice::where('statut', 'active')
            ->orWhere('statut', 'clôturée')
            ->pluck('annee_exercice', 'id');
        $anneeExercice_encour = AnneeExercice::where('statut', 'active')
            ->where('annee_exercice', now()->format('Y'))
            ->first();
        if ($annee_id == null && $anneeExercice_encour) {

            $annee_id = $anneeExercice_encour->id;
        }
        $structure_id_v = 0;
        if ($structure_id == null) {
            $structure_id_v = 0;
        } else {
            $structure_id_v = $structure_id;
        }

        $programmes = Programme::all();

        $programmes_with_previsions = array();

        foreach ($programmes as $programme) {
            $previsions = Prevision::getPrevisionByCommune($commune_id, $annee_id, $structure_id_v, $programme->id);
            $realisations = Realisation::getRealisationByCommune($commune_id, $annee_id, $structure_id_v, $programme->id);

            if (!$previsions->isEmpty()) {
                $lava_prevision = new Lavacharts;
                $lava_prevision = $this->getGraphePrevision($previsions, "previsions" . $programme->id);

                $programmes_data["id_programme"] = $programme->id;
                $programmes_data["titre_programme"] = $programme->titre;

                if (!$realisations->isEmpty()) {
                    $lava_realisation = new Lavacharts;
                    $lava_realisation = $this->getGrapheRealisation($realisations, "realisations" . $programme->id);
                    $programmes_data["is_content_realisation"] = 1;
                } else {
                    $programmes_data["is_content_realisation"] = 0;
                }

                array_push($programmes_with_previsions, $programmes_data);
            }
        }
        if ($structure_id == null) {
            return view('statistiques.par_commune', ['programmes_with_previsions' => $programmes_with_previsions, 'commune_id' => $commune_id, 'communes' => $communes, 'anneeExercices' => $anneeExercices, 'annee_id' => $annee_id, 'structures' => $structures, 'structure_id' => $structure_id_v]);
        } else {
            return view('statistiques.grapheCommune', ['programmes_with_previsions' => $programmes_with_previsions, 'commune_id' => $commune_id, 'communes' => $communes, 'anneeExercices' => $anneeExercices, 'annee_id' => $annee_id, 'structures' => $structures, 'structure_id' => $structure_id_v]);
        }
    }


    public function getStatistiqueByProvince($annee_id = null, $structure_id = null, $province_id = null)
    {
        $provinces = Province::getProvinceWithPrevision()->pluck('nom_province', 'id');

        $structures = Structure::getStructureWithPrevision()->pluck('nom_struct', 'id');

        $anneeExercices = AnneeExercice::where('statut', 'active')
            ->orWhere('statut', 'clôturée')
            ->pluck('annee_exercice', 'id');
        $anneeExercice_encour = AnneeExercice::where('statut', 'active')
            ->where('annee_exercice', now()->format('Y'))
            ->first();
        if ($annee_id == null && $anneeExercice_encour) {

            $annee_id = $anneeExercice_encour->id;
        }

        $structure_id_v = 0;
        if ($structure_id == null) {
            $structure_id_v = 0;
        } else {
            $structure_id_v = $structure_id;
        }

        $programmes = Programme::all();

        $programmes_with_previsions = array();

        foreach ($programmes as $programme) {
            $previsions = Prevision::getPrevisionByProvince($province_id, $annee_id, $structure_id_v, $programme->id);
            $realisations = Realisation::getRealisationByProvince($province_id, $annee_id, $structure_id_v, $programme->id);

            if (!$previsions->isEmpty()) {
                $lava_prevision = new Lavacharts;
                $lava_prevision = $this->getGraphePrevision($previsions, "previsions" . $programme->id);

                $programmes_data["id_programme"] = $programme->id;
                $programmes_data["titre_programme"] = $programme->titre;
                if (!$realisations->isEmpty()) {
                    $lava_realisation = new Lavacharts;
                    $lava_realisation = $this->getGrapheRealisation($realisations, "realisations" . $programme->id);
                    $programmes_data["is_content_realisation"] = 1;
                } else {
                    $programmes_data["is_content_realisation"] = 0;
                }
                array_push($programmes_with_previsions, $programmes_data);
            }
        }
        if ($structure_id == null) {
            return view('statistiques.par_province', ['programmes_with_previsions' => $programmes_with_previsions, 'province_id' => $province_id, 'provinces' => $provinces, 'anneeExercices' => $anneeExercices, 'annee_id' => $annee_id, 'structures' => $structures, 'structure_id' => $structure_id_v]);
        } else {
            return view('statistiques.grapheProvince', ['programmes_with_previsions' => $programmes_with_previsions, 'province_id' => $province_id, 'provinces' => $provinces, 'anneeExercices' => $anneeExercices, 'annee_id' => $annee_id, 'structures' => $structures, 'structure_id' => $structure_id_v]);
        }
    }

    public function getStatistiqueByRegion($annee_id = null, $structure_id = null, $region_id = null)
    {
        $regions = Region::getRegionWithPrevision()->pluck('nom_region', 'id');

        $structures = Structure::getStructureWithPrevision()->pluck('nom_struct', 'id');

        $anneeExercices = AnneeExercice::where('statut', 'active')
            ->orWhere('statut', 'clôturée')
            ->pluck('annee_exercice', 'id');
        $anneeExercice_encour = AnneeExercice::where('statut', 'active')
            ->where('annee_exercice', now()->format('Y'))
            ->first();
        if ($annee_id == null && $anneeExercice_encour) {
            $annee_id = $anneeExercice_encour->id;
        }

        $structure_id_v = 0;
        if ($structure_id == null) {
            $structure_id_v = 0;
        } else {
            $structure_id_v = $structure_id;
        }

        $programmes = Programme::all();

        $programmes_with_previsions = array();

        foreach ($programmes as $programme) {
            $previsions = Prevision::getPrevisionByRegion($region_id, $annee_id, $structure_id_v, $programme->id);
            $realisations = Realisation::getRealisationByRegion($region_id, $annee_id, $structure_id_v, $programme->id);

            if (!$previsions->isEmpty()) {
                $lava_prevision = new Lavacharts;
                $lava_prevision = $this->getGraphePrevision($previsions, "previsions" . $programme->id);

                $programmes_data["id_programme"] = $programme->id;
                $programmes_data["titre_programme"] = $programme->titre;
                if (!$realisations->isEmpty()) {
                    $lava_realisation = new Lavacharts;
                    $lava_realisation = $this->getGrapheRealisation($realisations, "realisations" . $programme->id);
                    $programmes_data["is_content_realisation"] = 1;
                } else {
                    $programmes_data["is_content_realisation"] = 0;
                }
                array_push($programmes_with_previsions, $programmes_data);
            }
        }
        if ($structure_id == null) {
            return view('statistiques.par_region', ['programmes_with_previsions' => $programmes_with_previsions, 'region_id' => $region_id, 'regions' => $regions, 'anneeExercices' => $anneeExercices, 'annee_id' => $annee_id, 'structures' => $structures, 'structure_id' => $structure_id_v]);
        } else {
            return view('statistiques.grapheRegion', ['programmes_with_previsions' => $programmes_with_previsions, 'region_id' => $region_id, 'regions' => $regions, 'anneeExercices' => $anneeExercices, 'annee_id' => $annee_id, 'structures' => $structures, 'structure_id' => $structure_id_v]);
        }
    }

    public function getStatistiqueNationale($annee_id = null)
    {
        $anneeExercices = AnneeExercice::where('statut', 'active')
            ->orWhere('statut', 'clôturée')
            ->pluck('annee_exercice', 'id');
        $anneeExercice_encour = AnneeExercice::where('statut', 'active')
            ->where('annee_exercice', now()->format('Y'))
            ->first();

        $annee_id_v = 0;

        if ($annee_id == null && $anneeExercice_encour) {

            $annee_id_v = $anneeExercice_encour->id;
        } else {
            $annee_id_v = $annee_id;
        }

        $programmes = Programme::all();

        $programmes_with_previsions = array();

        foreach ($programmes as $programme) {
            $previsions = Prevision::getPrevisionNationale($programme->id, $annee_id_v);
            $realisations = Realisation::getRealisationNationale($programme->id, $annee_id_v);

            if (!$previsions->isEmpty()) {
                $lava_prevision = new Lavacharts;
                $lava_prevision = $this->getGraphePrevision($previsions, "previsions" . $programme->id);

                $programmes_data["id_programme"] = $programme->id;
                $programmes_data["titre_programme"] = $programme->titre;
                if (!$realisations->isEmpty()) {
                    $lava_realisation = new Lavacharts;
                    $lava_realisation = $this->getGrapheRealisation($realisations, "realisations" . $programme->id);
                    $programmes_data["is_content_realisation"] = 1;
                } else {
                    $programmes_data["is_content_realisation"] = 0;
                }
                array_push($programmes_with_previsions, $programmes_data);
            }
        }

        if ($annee_id == null) {
            return view('statistiques.nationale', ['programmes_with_previsions' => $programmes_with_previsions, 'anneeExercices' => $anneeExercices, 'annee_id' => $annee_id_v]);
        } else {
            return view('statistiques.grapheNationale', ['programmes_with_previsions' => $programmes_with_previsions, 'anneeExercices' => $anneeExercices, 'annee_id' => $annee_id_v]);
        }
    }

    public function histogrammeStatistique()
    {

        $previsions = DB::table('previsions')
            ->select(
                DB::raw('SUM(previsions.effectif_homme_prevu) as total_EH'),
                DB::raw('SUM(previsions.effectif_femme_prevu) as total_EF'),
                'communes.id as commune_id',
                'communes.nom_commune as nom_commune',
                'sous_indicateurs.lib_sous_ind as lib_sous_ind'
            )
            ->join('communes', 'previsions.commune_id', '=', 'communes.id')
            ->join('sous_indicateurs', 'previsions.sous_indicateur_id', '=', 'sous_indicateurs.id')
            ->groupBy('communes.id', 'communes.nom_commune', 'sous_indicateurs.lib_sous_ind')
            ->get();
        $lava = new Lavacharts;
        $datas = \Lava::DataTable();

        $datas->addStringColumn('nom_region')
            ->addNumberColumn('Effectif homme bénéficiaire')
            ->addNumberColumn('Effectif femme bénéficiaire');

        foreach ($previsions as $prevision) {
            $datas->addRow([$prevision->nom_commune, $prevision->total_EH, $prevision->total_EF]);
        }

        \Lava::ColumnChart('Previsions', $datas, [
            'title' => 'Prévisions',
            'titleTextStyle' => [
                'color'    => '#eb6b2c',
                'fontSize' => 14
            ]
        ]);

        return $lava;
    }


    public function getGrapheRealisationByProgramme($realisations)
    {

        $lava = new Lavacharts;
        $datas = \Lava::DataTable();

        $datas->addStringColumn('titre_prog')
            ->addNumberColumn('Effectif Total Bénéficiaire')
            ->addNumberColumn('Effectif homme bénéficiaire')
            ->addNumberColumn('Effectif femme bénéficiaire');

        foreach ($realisations as $realisation) {
            $datas->addRow([$realisation->titre_prog, $realisation->total_T, $realisation->total_EH, $realisation->total_EF]);
        }

        \Lava::ColumnChart('Realisations', $datas, [
            'title' => 'Réalisations',
            'titleTextStyle' => [
                'color'    => '#eb6b2c',
                'fontSize' => 14
            ],
            'legend' => [
                'position' => 'top'
            ]
        ]);

        return $lava;
    }

    public function reloadStatistiqueNationaleByProgramme($annee_id = null)
    {
        $anneeExercices = AnneeExercice::all()->where('annee_exercice', '<=', now()->format('Y') - 1)->pluck('annee_exercice', 'id');

        $anneeExercice_encour = AnneeExercice::all()
            ->where('annee_exercice', '<=', now()->format('Y') - 1)
            ->first();
        if ($annee_id == null) {
            $annee_id = $anneeExercice_encour->id;
        }

        $realisations = Realisation::getRealisationNationaleByProgramme($annee_id);

        $lava = new Lavacharts;
        $lava = $this->getGrapheRealisationByProgramme($realisations);
        return view('statistiques.grapheNationaleByProgramme', ['anneeExercices' => $anneeExercices, 'annee_id' => $annee_id, 'lava' => $lava]);
    }

    public function getEffSal()
    {
        $annee = $_GET['annee'];
        $mois = $_GET['mois'];
        return view('statistiques.diagrammefts', ['annee' => $annee, 'mois' => $mois]);
    }

    public function getEffSalTit()
    {
        $annee = $_GET['annee'];
        $mois = $_GET['mois'];
        $dep_id = $_GET['dep_id'];
        $departements = Departement::all()->pluck('nom', 'id');
        return view('statistiques.diagrammtit', ['annee' => $annee, 'mois' => $mois, 'dep_id' => $dep_id, 'departements' => $departements]);
    }

    public function getPyrAge()
    {
        $annee = $_GET['annee'];
        $mois = $_GET['mois'];
        return view('statistiques.diagrammage', ['annee' => $annee, 'mois' => $mois]);
    }

    public function getRealisation()
    {
        if (isset($_GET['ae'])) {
            $annee_id = $_GET['ae'];
            // if ($annee_id != 0) {
            //     $data = Reponse::where('annee_id', $annee_id)->where('type', '=', 'prevision')->get();
            // } else {
            //     $data = Reponse::where('type', '=', 'prevision')->get();
            // }
        } else {
            $annee = AnneeExercice::anneeActive();
            $annee_id = $annee->id;
            // $data = Reponse::where('annee_id', $annee_id)->where('type', '=', 'prevision')->get();
        }

        if (isset($_GET['st'])) {
            $structure_id = $_GET['st'];
            // if ($structure_id != 0) {
            //     $data = $data->where('structure_id', $structure_id);
            // } else {
            //     $data = $data;
            // }
        } else {
            $annee = AnneeExercice::anneeActive();
            $annee_id = $annee->id;
            if (User::authUserProfil()->nom != 'Administrateur') {
                $user = Auth::user();
                $structure_id = $user->structure_id;
            } else {
                $structure_id = 0;
            }

            // $data = Reponse::where('annee_id', $annee_id)->where('type', '=', 'prevision')->get();
        }


        $produits = DB::table('produits')
            ->selectRaw('produits.*,plan_approvisions.montant_total,plan_approvisions.id as prevision_id,plan_approvisions.taux,(plan_realisations.montant_local/plan_realisations.montant_total)*100 as quota')
            //->join('liste_produits', 'liste_produits.produit_id', '=', 'produits.id')
            ->join('plan_approvisions', 'plan_approvisions.produit_id', '=', 'produits.id')
            ->join('plan_realisations', 'plan_realisations.plan_approvision_id', '=', 'plan_approvisions.id')
            ->join('reponses', 'reponses.id', '=', 'plan_approvisions.reponse_id')
            ->where('reponses.annee_id', $annee_id)
            ->where('reponses.structure_id', $structure_id)
            ->get();
        //dd($produits);

        $autresProduits = DB::table('produits')
            ->selectRaw('produits.*,plan_approvisions.montant_total,plan_approvisions.id as prevision_id,plan_approvisions.taux,(plan_realisations.montant_local/plan_realisations.montant_total)*100 as quota')
            ->join('plan_approvisions', 'plan_approvisions.produit_id', '=', 'produits.id')
            ->join('plan_realisations', 'plan_realisations.plan_approvision_id', '=', 'plan_approvisions.id')
            ->join('reponses', 'reponses.id', '=', 'plan_approvisions.reponse_id')
            ->where('produits.decret', '=', 0)
            ->where('reponses.annee_id', $annee_id)
            ->where('reponses.structure_id', $structure_id)
            ->get();

        //dd($produits);
        if (isset($_GET['ty'])) {
            $type = $_GET['ty'];
            if ($type == 'tout') {
                $produits = $produits;
                $autresProduits = $autresProduits;
            } else {
                if ($type == 'service') {
                    $produits = $produits->where('type', '=', 'Service');
                    $autresProduits = $autresProduits->where('type', '=', 'Service');
                } else {
                    if ($type == 'bien') {
                        $produits = $produits->where('type', '=', 'Bien');
                        $autresProduits = $autresProduits->where('type', '=', 'Bien');
                    } else {
                        $produits = $produits->where('type', $type);
                        $autresProduits = $autresProduits->where('type', $type);
                    }
                }
            }
        } else {
            $produits = $produits;
            $autresProduits = $autresProduits;
            $type = "tout";
        }

        //dd($produits);
        if (isset($_GET['ca'])) {
            $categorie = $_GET['ca'];
            if ($categorie == 'tout') {
                $produits = $produits;
            } else {
                if ($categorie == 'oui') {
                    $produits = $produits->where('decret', '=', 1);
                } else {
                    if ($categorie == 'non') {
                        $produits = $produits->where('decret', '=', 0);
                    } else {
                        $produits = $produits->where('decret', $categorie);
                    }
                }
            }
        } else {
            $produits = $produits;
            $categorie = "tout";
        }

        //dd($user->structure->phase_struct);

        $reponse = Reponse::where('annee_id', $annee_id)->where('type', '=', 'realisation')->where('structure_id', $structure_id)->get()->first();
        $phase = "phase_struct";
        if ($reponse != null) {
            # code...
            $reponse_id = $reponse->id;
        } else {
            $reponse_id = 0;
        }
        $annee = AnneeExercice::where('id', $annee_id)->get()->first();
        $fournisseurs = Fournisseur::all();

        return view('rapports.realisation.show', ['ae' => $annee_id, 'st' => $structure_id, 'type' => $type, 'options' => $produits, 'phase' => $phase, 'reponse_id' => $reponse_id, 'fournisseurs' => $fournisseurs, 'annee' => $annee, 'autresProduits' => $autresProduits, 'categorie' => $categorie]);
    }

    public function getRealisationTotale()
    {
        if (isset($_GET['ae'])) {
            $annee_id = $_GET['ae'];
        } else {
            $annee = AnneeExercice::anneeActive();
            $annee_id = $annee->id;
        }

        $produits = DB::table('produits')
            ->selectRaw('produits.libelle,produits.type,produits.decret,sum(plan_approvisions.montant_total) as prevision_total,AVG(plan_approvisions.taux) as taux,SUM(plan_realisations.montant_local) as realisation_local,SUM(plan_realisations.montant_total) as realisation_total')
            //->join('liste_produits', 'liste_produits.produit_id', '=', 'produits.id')
            ->join('plan_approvisions', 'plan_approvisions.produit_id', '=', 'produits.id')
            ->join('plan_realisations', 'plan_realisations.plan_approvision_id', '=', 'plan_approvisions.id')
            ->join('reponses', 'reponses.id', '=', 'plan_approvisions.reponse_id')
            ->where('reponses.annee_id', $annee_id)
            ->groupBy('produits.libelle','produits.type','produits.decret')
            ->get();
        //dd($produits);

        $autresProduits = DB::table('produits')
        ->selectRaw('produits.libelle,produits.type,produits.decret,sum(plan_approvisions.montant_total) as prevision_total,AVG(plan_approvisions.taux) as taux,SUM(plan_realisations.montant_local) as realisation_local,SUM(plan_realisations.montant_total) as realisation_total')
            ->join('plan_approvisions', 'plan_approvisions.produit_id', '=', 'produits.id')
            ->join('plan_realisations', 'plan_realisations.plan_approvision_id', '=', 'plan_approvisions.id')
            ->join('reponses', 'reponses.id', '=', 'plan_approvisions.reponse_id')
            ->where('produits.decret', '=', 0)
            ->where('reponses.annee_id', $annee_id)
            ->groupBy('produits.libelle','produits.type','produits.decret')
            ->get();

        //dd($produits);
        if (isset($_GET['ty'])) {
            $type = $_GET['ty'];
            if ($type == 'tout') {
                $produits = $produits;
                $autresProduits = $autresProduits;
            } else {
                if ($type == 'service') {
                    $produits = $produits->where('type', '=', 'Service');
                    $autresProduits = $autresProduits->where('type', '=', 'Service');
                } else {
                    if ($type == 'bien') {
                        $produits = $produits->where('type', '=', 'Bien');
                        $autresProduits = $autresProduits->where('type', '=', 'Bien');
                    } else {
                        $produits = $produits->where('type', $type);
                        $autresProduits = $autresProduits->where('type', $type);
                    }
                }
            }
        } else {
            $produits = $produits;
            $autresProduits = $autresProduits;
            $type = "tout";
        }

        //dd($produits);
        if (isset($_GET['ca'])) {
            $categorie = $_GET['ca'];
            if ($categorie == 'tout') {
                $produits = $produits;
            } else {
                if ($categorie == 'oui') {
                    $produits = $produits->where('decret', '=', 1);
                } else {
                    if ($categorie == 'non') {
                        $produits = $produits->where('decret', '=', 0);
                    } else {
                        $produits = $produits->where('decret', $categorie);
                    }
                }
            }
        } else {
            $produits = $produits;
            $categorie = "tout";
        }

        // dd($produits);

        //dd($user->structure->phase_struct);

        $reponse = Reponse::where('annee_id', $annee_id)->where('type', '=', 'realisation')->get()->first();
        $phase = "phase_struct";
        if ($reponse != null) {
            # code...
            $reponse_id = $reponse->id;
        } else {
            $reponse_id = 0;
        }
        $annee = AnneeExercice::where('id', $annee_id)->get()->first();
        $fournisseurs = Fournisseur::all();

        return view('rapports.realisation.visio', ['ae' => $annee_id, 'type' => $type, 'options' => $produits, 'phase' => $phase, 'reponse_id' => $reponse_id, 'fournisseurs' => $fournisseurs, 'annee' => $annee, 'autresProduits' => $autresProduits, 'categorie' => $categorie]);
    }
}
