<?php


use App\Http\Controllers\AnneeExerciceController;
use App\Http\Controllers\DemandeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfilController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StatistiqueController;
use App\Http\Controllers\StructureController;
use App\Http\Controllers\FournisseurController;
use App\Http\Controllers\ListeProduitController;
use App\Http\Controllers\PhaseController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\PlanApprovisionController;
use App\Http\Controllers\PlanRealisationController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\ReponseController;
//use Khill\Lavacharts\Lavacharts;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {

//     return view('welcome');
// })->name('home');
Route::get('/', [HomeController::class, "index"])->middleware(['auth'])->name('home');
// Route::get('/', [HomeController::class, "acceuil"])->name('home');
Route::get('/dashboard', [HomeController::class, "index"])->middleware(['auth'])->name('dashboard');
Route::get('/public-approvisionement', [HomeController::class, "approvision"])->name('public-approvisionement');
Route::get('/public-societes', [HomeController::class, "societes"])->name('public-societes');
Route::get('/details-prevision/{id}', [HomeController::class, "details"])->name('details');
// Route::get('/home-statistiques-reload/{annee_id?}',[HomeController::class,"reloadHomeStatistique"])->name("dashboard.home-reload");

Route::resource('user', UserController::class)->middleware('auth')->middleware(['auth']);
Route::get('changePassword', [UserController::class, "showChangePasswordForm"])->name('changePassword')->middleware(['auth']);
Route::post('changeUserPassword', [UserController::class, "changeUserPassword"])->name('changeUserPassword')->middleware(['auth']);
Route::get('/supprimer-utilisateur/{id}', [UserController::class, "destroy"])->name('user.delete')->middleware(['auth']);
Route::get('/liste-utilisateurs', [UserController::class, "getListe"])->name("user.getListe")->middleware(['auth']);
Route::get('/desactiver-utilisateur/{id}', [UserController::class, "desactiverUtilisateur"])->name('user.desactive')->middleware(['auth']);
Route::get('/reactiver-utilisateur/{id}', [UserController::class, "reactiverUtilisateur"])->name('user.reactive')->middleware(['auth']);




Route::resource('annee-exercices', AnneeExerciceController::class);
Route::get('/supprimer-annee-exercice/{id}', [AnneeExerciceController::class, "destroy"])->name('annee-exercices.delete')->middleware(['auth']);
Route::get('/annee-exercice-activer/{id}', [AnneeExerciceController::class, "activer"])->name('annee-exercices.activer')->middleware(['auth']);
Route::get('/annee-exercice-cloturer/{id}', [AnneeExerciceController::class, "cloturer"])->name('annee-exercices.cloturer')->middleware(['auth']);
Route::get('/liste-annee-exercice', [AnneeExerciceController::class, "getListe"])->name("annee-exercices.getListe")->middleware(['auth']);


Route::resource('statistiques', StatistiqueController::class)->middleware(['auth']);

Route::get('graphique-statistiques-nationales-par-indicateurs/charts', [StatistiqueController::class, "getNationalesStatistiquesByIndicateurs"])->name('statistiques-nationale-par-indicateurs')->middleware(['auth']);

Route::get('/statistiques-par-commune/{annee_id?}/{structure_id?}/{commune_id?}', [StatistiqueController::class, "getStatistiqueByCommune"])->name("statiques.par-commune")->middleware(['auth']);
Route::get('/statistiques-par-province/{annee_id?}/{structure_id?}/{province_id?}', [StatistiqueController::class, "getStatistiqueByProvince"])->name("statiques.par-province")->middleware(['auth']);
Route::get('/statistiques-par-region/{annee_id?}/{structure_id?}/{region_id?}', [StatistiqueController::class, "getStatistiqueByRegion"])->name("statiques.par-region")->middleware(['auth']);
Route::get('/statistiques-nationale/{annee_id?}', [StatistiqueController::class, "getStatistiqueNationale"])->name("statiques.nationale")->middleware(['auth']);
Route::get('/statistiques-dep', [StatistiqueController::class, "getEffSal"])->name("statiques.effsal")->middleware(['auth']);
Route::get('/statistiques-depage', [StatistiqueController::class, "getPyrAge"])->name("statiques.pyrage")->middleware(['auth']);
Route::get('/statistiques-tit', [StatistiqueController::class, "getEffSalTit"])->name("statiques.effsaltit")->middleware(['auth']);

Route::get('/statistiques-realisation', [StatistiqueController::class, "getRealisation"])->name("statiques.realisation")->middleware(['auth']);
Route::get('/statistiques-realisation-visio', [StatistiqueController::class, "getRealisationTotale"])->name("statiques.realisation-visio")->middleware(['auth']);



Route::resource('profils', ProfilController::class)->middleware(['auth']);
Route::get('/supprimer-profil/{id}', [ProfilController::class, "destroy"])->name('profils.delete')->middleware(['auth']);
Route::get('/liste-profil', [ProfilController::class, "getListe"])->name("profils.getListe")->middleware(['auth']);

Route::resource('structures', StructureController::class)->middleware(['auth']);
Route::get('/supprimer-structure/{id}', [StructureController::class, "destroy"])->name('structures.delete')->middleware(['auth']);
Route::get('/liste-structure', [StructureController::class, "getListe"])->name("structures.getListe")->middleware(['auth']);

Route::resource('phases', PhaseController::class)->middleware(['auth']);
Route::get('/supprimer-phase/{id}', [PhaseController::class, "destroy"])->name('phases.delete')->middleware(['auth']);
Route::get('/liste-phase', [PhaseController::class, "getListe"])->name("phases.getListe")->middleware(['auth']);

Route::resource('produits', ProduitController::class)->middleware(['auth']);
Route::get('/supprimer-produit/{id}', [ProduitController::class, "destroy"])->name('produits.delete')->middleware(['auth']);
Route::get('/liste-produit', [ProduitController::class, "getListe"])->name("produits.getListe")->middleware(['auth']);

Route::resource('fournisseurs', FournisseurController::class)->middleware(['auth']);
Route::get('/supprimer-fournisseur/{id}', [FournisseurController::class, "destroy"])->name('fournisseurs.delete')->middleware(['auth']);
Route::get('/liste-fournisseurs', [FournisseurController::class, "getListe"])->name("fournisseurs.getListe")->middleware(['auth']);

Route::resource('listeProduits', ListeProduitController::class)->middleware(['auth']);
Route::get('/supprimer-listeProduit/{id}', [ListeProduitController::class, "destroy"])->name('listeProduits.delete')->middleware(['auth']);
Route::get('/liste-listeProduit', [ListeProduitController::class, "getListe"])->name("listeProduits.getListe")->middleware(['auth']);
Route::get('/filtre-liste', [ListeProduitController::class, "filtre"])->name("employers.filtre")->middleware(['auth']);
Route::post('/liste-copier', [ListeProduitController::class, "copier"])->name("listeProduits.copier")->middleware(['auth']);

Route::resource('reponses', ReponseController::class)->middleware(['auth']);
Route::get('/supprimer-reponse/{id}', [ReponseController::class, "destroy"])->name('reponses.delete')->middleware(['auth']);
Route::get('/liste-reponse', [ReponseController::class, "getListe"])->name("reponses.getListe")->middleware(['auth']);
Route::get('/filtre-liste', [ReponseController::class, "filtre"])->name("reponses.filtre")->middleware(['auth']);
Route::post('/admin/ligne/{id}/valider', [ReponseController::class, 'valider'])->name('reponses.update')->middleware('auth');
Route::get('/admin/resp/option', [ReponseController::class, 'getOption'])->name('reponses.getOption')->middleware('auth');
Route::get('/admin/resp/pdt', [ReponseController::class, 'getProduit'])->name('reponses.getProduit')->middleware('auth');
Route::get('/reponse/envoyer/{id}', [ReponseController::class, 'envoyerListe'])->name('reponses.envoyerListe')->middleware('auth');

Route::post('/admin/reponse/store', [PlanApprovisionController::class, 'store'])->name('reponses.envoyer')->middleware('auth');

Route::resource('approvisions', PlanRealisationController::class)->middleware(['auth']);
Route::get('/supprimer-approvision/{id}', [PlanRealisationController::class, "destroy"])->name('approvisions.delete')->middleware(['auth']);
Route::get('/liste-approvision', [PlanRealisationController::class, "getListe"])->name("approvisions.getListe")->middleware(['auth']);
Route::get('/filtre-liste', [PlanRealisationController::class, "filtre"])->name("approvisions.filtre")->middleware(['auth']);
Route::post('/admin/ligne/{id}/valider', [PlanRealisationController::class, 'valider'])->name('approvisions.update')->middleware('auth');
Route::get('/admin/ligne/option', [PlanRealisationController::class, 'getOption'])->name('approvisions.getOption')->middleware('auth');
Route::get('/admin/ligne/pdt', [PlanRealisationController::class, 'getProduit'])->name('approvisions.getProduit')->middleware('auth');
Route::get('/realisation/envoyer/{id}', [PlanRealisationController::class, 'envoyerListe'])->name('approvisions.envoyerListe')->middleware('auth');

Route::post('/admin/approvision/store', [PlanRealisationController::class, 'store'])->name('approvisions.envoyer')->middleware('auth');

Route::resource('demandes', DemandeController::class);
Route::get('/supprimer-demande/{id}', [DemandeController::class, "destroy"])->name('demandes.delete')->middleware(['auth']);
Route::get('/valider-demande/{id}', [DemandeController::class, "valider"])->name('demandes.valider')->middleware(['auth']);
Route::get('/rejeter-demande/{id}', [DemandeController::class, "rejeter"])->name('demandes.rejeter')->middleware(['auth']);
Route::get('/liste-demande', [DemandeController::class, "getListe"])->name("demandes.getListe")->middleware(['auth']);

Route::resource('photos', PhotoController::class);
Route::post('/modifier-photo/{photo}', [PhotoController::class, "update"])->name('photos.update')->middleware(['auth']);
Route::get('/supprimer-photo/{id}', [PhotoController::class, "destroy"])->name('photos.delete')->middleware(['auth']);
Route::get('/liste-photo', [PhotoController::class, "getListe"])->name("photos.getListe")->middleware(['auth']);

require __DIR__ . '/auth.php';
