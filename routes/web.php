<?php

use App\Http\Controllers\BilletController;
use App\Http\Controllers\CategorieMarchandiseController;
use App\Http\Controllers\CategorieMaterielController;
use App\Http\Controllers\ClotureController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\EncaissementController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DecaissementController;
use App\Http\Controllers\EmployeController;
use App\Http\Controllers\EntreMarchandiseController;
use App\Http\Controllers\EntreMaterielController;
use App\Http\Controllers\InventaireMarchandiseController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\MarchandiseController;
use App\Http\Controllers\MaterielController;
use App\Http\Controllers\MaterielIntermediaireController;
use App\Http\Controllers\ReglementController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SortieMarchandiseController;
use App\Http\Controllers\SuivicaisseController;
use App\Http\Controllers\SuiviTierController;
use App\Http\Controllers\TierController;

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



Route::get('login',[UserController::class,'login'])->name('user.login');
Route::post('login',[UserController::class,'authenticate'])->name('user.auth');
Route::post('infoAuhtnticate',[UserController::class,'infoAuthenticate'])->name('user.info.authenticate');
Route::get('materiel/information/{materiel}', [MaterielController::class, 'InfoMateriel'])->name('materiel.info');
Route::get('/', function () {
        return view('home');
    })->name('home');

Route::middleware(['auth'])->group(function () {
    // Route::get('home', function () {
    //     return view('home');
    // })->name('home');

    // Route::resource('user', UserController::class);
    // Route::resource('roles', RoleController::class);
    Route::resource('employes', EmployeController::class);

    Route::get('roles', [RoleController::class, 'index'])->name('roles.index');
    Route::get('roles/{id}', [RoleController::class,'show'])->name('roles.show');
    Route::put('roles/update/{id}', [RoleController::class,'update'])->name('roles.update');
    Route::get('roles/{id}/edit', [RoleController::class,'edit'])->name('roles.edit');
    Route::delete('roles/destroy/{user}', [RoleController::class,'destroy'])->name('roles.destroy');
    Route::post('roles/store',[RoleController::class, 'store'])->name('roles.store');

    Route::get('user', [UserController::class, 'index'])->name('user.index');
    Route::get('user/{user}', [UserController::class,'show'])->name('user.show');
    Route::put('user/mot_de_passe/{user}', [UserController::class,'resetPassword'])->name('user.resetPassword');
    Route::put('user/update/{user}', [UserController::class,'update'])->name('user.update');
    Route::delete('user/destroy/{user}', [UserController::class,'destroy'])->name('user.destroy');
    Route::post('user/store',[UserController::class, 'store'])->name('user.store');
    Route::get('caisse/inventaire', [BilletController::class,'index'])->name('caisse.inventaire');

    Route::post('logout',[UserController::class,'logout'])->name('user.logout');
    Route::get('caisse/home', [Controller::class, 'caisseHome'])->name('caisse.home');
    Route::get('encaissements', [EncaissementController::class,'index'])->name('caisse.encaissement.index');
    Route::put('encaissements/update/{encaissement}', [EncaissementController::class,'update'])->name('caisse.encaissement.update');
    Route::put('decaissements/update/{decaissement}', [DecaissementController::class,'update'])->name('caisse.decaissement.update');
    Route::post('encaissement',[EncaissementController::class, 'store'])->name('caisse.encaissement.store');

    Route::get('decaissements', [DecaissementController::class,'index'])->name('caisse.decaissement.index');
    Route::post('decaissement',[DecaissementController::class, 'store'])->name('caisse.decaissement.store');

    Route::post('decaissement/searchTransport',[DecaissementController::class, 'transportIndex'])->name('caisse.decaissement.searchTransport');

    Route::get('decaissement/transport',[DecaissementController::class, 'transportIndex'])->name('caisse.decaissement.transport');
    Route::get('decaissement/communication',[DecaissementController::class, 'communicationIndex'])->name('caisse.decaissement.communication');

    Route::get('decaissement/autre_decaissement',[DecaissementController::class, 'autreDecaissementIndex'])->name('caisse.decaissement.autre');

    Route::get('decaissement/carburant',[DecaissementController::class, 'carburantIndex'])->name('caisse.decaissement.carburant');

    Route::get('decaissement/cloture-de-caisse',[DecaissementController::class, 'clotureDeCaisseIndex'])->name('caisse.clotureDeCaisse');

    Route::post('reglement',[ReglementController::class, 'store'])->name('caisse.reglement.store');

    Route::post('search/Carburant',[DecaissementController::class, 'searchCarburant'])->name('caisse.decaissement.searchCarburant');

    Route::post('search/Communication',[DecaissementController::class, 'searchCommunication'])->name('caisse.decaissement.searchCommunication');

    Route::post('search/autre_decaissement',[DecaissementController::class, 'searchAutreDecaissement'])->name('caisse.decaissement.searchautre');

    Route::put('controle/{id}', [ClotureController::class,'controle'])->name('cloture.controle');
    Route::post('decaissement/search/cloture-de-caisse', [DecaissementController::class,'clotureDeCaisseIndex'])->name('cloture.search');


    Route::get('caisse/suivi',[SuivicaisseController::class, 'index'])->name('caisse.suivi.index');

    Route::post('suivi/caisse', [SuivicaisseController::class,'store'])->name('caisse.suivi.store');
    Route::get('encaissement/export/{id}', [EncaissementController::class,'createEncaissementPdf'])->name('caisse.encaissement.export');

    Route::get('decaissment/export/{id}', [DecaissementController::class,'createDecaissementPdf'])->name('caisse.decaissement.export');

    Route::post('suivi/store', [BilletController::class,'store'])->name('caisse.billet.store');



    // ROUTES DE GESTION DES MARCHANDISES

    Route::get('marchandise/dashboard', [Controller::class, 'marchandiseDashboard'])->name('marchandise.dashboard');
    Route::get('marchandise/entres', [MarchandiseController::class, 'entre'])->name('marchandise.entre');
    Route::post('marchandise/store', [MarchandiseController::class,'store'])->name('marchandise.store');

//catégorie
    Route::get('marchandise/categorie/index', [CategorieMarchandiseController::class, 'index'])->name('marchandise.categorie.index');
    Route::post('marchandise/categorie/store', [CategorieMarchandiseController::class,'store'])->name('marchandise.categorie.store');
    Route::get('marchandise/categorie/show/{id}', [CategorieMarchandiseController::class, 'show'])->name('marchandise.categorie.show');
    Route::delete('marchandise/categorie/destroy/{categorieMarchandise}', [CategorieMarchandiseController::class, 'destroy'])->name('marchandise.categorie.delete');

    Route::get('marchandise/show/{id}', [MarchandiseController::class, 'show'])->name('marchandise.show');
    Route::post('marchandise/store', [MarchandiseController::class, 'store'])->name('marchandise.store');

    Route::post('marchandise/entree/store', [EntreMarchandiseController::class, 'store'])->name('marchandise.entree.store');

    Route::post('marchandise/sortie/store', [SortieMarchandiseController::class, 'store'])->name('marchandise.sortie.store');

    Route::get('marchandise', [MarchandiseController::class, 'index'])->name('marchandise.index');

    Route::delete('marchandise/destroy/{$id}', [MarchandiseController::class, 'destroy'])->name('marchandise.delete');

    Route::get('marchandise/inventaire/index', [InventaireMarchandiseController::class, 'index'])->name('marchandise.inventaire.index');

    Route::post('marchandise/inventaire/store', [InventaireMarchandiseController::class, 'store'])->name('marchandise.inventaire.store');

    Route::get('marchandise/inventaire/show/{inventaire}', [InventaireMarchandiseController::class, 'show'])->name('marchandise.inventaire.show');

    Route::get('marchandise/entres', [EntreMarchandiseController::class, 'index'])->name('marchandise.entres');

    Route::get('marchandise/sorties', [SortieMarchandiseController::class, 'index'])->name('marchandise.sorties');

    Route::put('marchandise/inventaire/update/{inventaire}', [InventaireMarchandiseController::class, 'update'])->name('marchandise.inventaire.update');

    Route::put('marchandise/entree/update/{entre}', [EntreMarchandiseController::class, 'update'])->name('marchandise.entree.update');

    Route::put('marchandise/sortie/update/{sortie}', [SortieMarchandiseController::class, 'update'])->name('marchandise.sortie.update');

    Route::delete('marchandise/entrees/{entre}', [EntreMarchandiseController::class, 'destroy'])->name('marcahndise.entre.delete');

    Route::delete('marchandise/sortie/{sortie}', [SortieMarchandiseController::class, 'destroy'])->name('marcahndise.sortie.delete');

// routes tiers

    Route::get('tiers/home', [Controller::class, 'tiersHome'])->name('tiers.home');
    Route::get('tiers/fournisseurs', [TierController::class, 'indexFournisseur'])->name('tiers.indexFournisseur');
    Route::post('tiers/store', [TierController::class, 'store'])->name('tiers.store');
    Route::get('tiers/autres', [TierController::class, 'indexAutre'])->name('tiers.indexAutre');
    Route::get('tiers/clients', [TierController::class, 'indexClient'])->name('tiers.indexClient');
    Route::delete('tiers/destroy/{tier}', [TierController::class, 'destroy'])->name('tier.delete');
    Route::get('tiers/show/{tier}', [TierController::class, 'show'])->name('tier.show');
    Route::get('tiers/show/fournisseur/{tier}', [TierController::class, 'showFournisseur'])->name('tier.showFournisseur');

    Route::post('tiers/suivis/store', [SuiviTierController::class, 'store'])->name('tiers.suivi.store');
    Route::put('tiers/suivis/update/{suiviTier}', [SuiviTierController::class, 'update'])->name('tiers.suivi.update');
    Route::delete('tiers/suivis/delete/{suiviTier}', [SuiviTierController::class, 'destroy'])->name('tiers.suivi.delete');

    ///////////
    Route::get('tiers/founisseur/csv/{tier}', [TierController::class, 'csv'])->name('tiers.founisseur.csv');

// routes immobilisation

    Route::get('materiel/categorie/index', [CategorieMaterielController::class, 'index'])->name('materiel.categorie.index');
    Route::post('materiel/categorie/store', [CategorieMaterielController::class,'store'])->name('materiel.categorie.store');

    Route::get('materiel/categorie/show/{categorie}', [CategorieMaterielController::class, 'show'])->name('materiel.categorie.show');

    Route::post('materiel/store', [MaterielController::class, 'store'])->name('materiel.store');


    Route::post('materiel/intermediaire/store', [MaterielIntermediaireController::class,'store'])->name('materiel.intermediaire.store');

    Route::post('materiel/entre/store', [EntreMaterielController::class,'store'])->name('materiel.entre.store');

    Route::put('materiel/entre/update/{entreMateriel}', [EntreMaterielController::class,'update'])->name('materiel.entre.update');

    Route::delete('materiel/entre/delete/{entreMateriel}', [EntreMaterielController::class,'destroy'])->name('materiel.entre.delete');

    Route::get('materiel/intermediaire/index', [MaterielIntermediaireController::class, 'index'])->name('materiel.intermediaire.index');

    Route::get('materiel/intermediaire/show/{materielIntermediaire}', [MaterielIntermediaireController::class, 'show'])->name('materiel.intermediaire.show');


    Route::put('materiel/intermediaire/update/{materielIntermediaire}', [MaterielIntermediaireController::class, 'update'])->name('materiel.intermediaire.update');

    Route::put('materiel/update/{materiel}', [MaterielController::class, 'update'])->name('materiel.update');

    Route::delete('materiel/intermediaire/{materielIntermediaire}', [MaterielIntermediaireController::class, 'destroy'])->name('materiel.intermediaire.delete');

    Route::delete('materiel/categorie/{categorieMateriel}', [CategorieMaterielController::class, 'destroy'])->name('materiel.categorie.delete');

    Route::get('materiel/show/{materiel}', [MaterielController::class, 'show'])->name('materiel.show');

    Route::get('materiel', [MaterielController::class,'index'])->name('materiel.index');

    Route::get('materiel/information/csv/{materiel}', [MaterielController::class, 'csv'])->name('materiel.info.csv');

    Route::get('materiel/export', [MaterielController::class, 'export_materiel'])->name('materiel.export.csv');

    Route::get('materiel/export/intermediaire', [MaterielIntermediaireController::class, 'exportIntermediaire'])->name('materiel.export.intermediaire');

    // ggénérer le qr code

    Route::get('materiel/qrcode', [MaterielController::class,'generateQrcode'])->name('materiel.generateQrcode');

    Route::delete('materiel/{materiel}', [MaterielController::class, 'destroy'])->name('materiel.delete');


    /// HISTORIQUE DE CONNECTION

    Route::get('logs/index', [LogController::class, 'index'])->name('log.index');


});
