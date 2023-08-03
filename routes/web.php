<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\EtablissementController;
use App\Http\Controllers\ResponsableController;
use App\Http\Controllers\EnseignantController;
use App\Http\Controllers\DossierController;
use App\Http\Controllers\TraitementController;
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
// });
Route::get('/login',  [LoginController::class, 'loginForm'])->name('login');
Route::post('/login',  [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout',  [LoginController::class, 'logout'])->name('logout');;
Route::get('/',  [AdminLoginController::class, 'loginForm'])->name('admin.login');
Route::get('/register',  [AdminLoginController::class, 'registerForm'])->name('admin.register');
Route::post('/register',  [AdminLoginController::class, 'register' ])->name('admin.register.submit');
Route::prefix('admin')->group(function() {

    Route::post('/login',  [AdminLoginController::class, 'login' ])->name('admin.login.submit');
    Route::get('/logout',  [AdminLoginController::class, 'logout' ])->name('admin.logout');

    Route::get('/',  [AdminController::class, 'index'])->name('admin.dashboard');
});

//etablissement
Route::prefix('etablissement')->group(function() {
    Route::get('/',  [EtablissementController::class, 'etablissement'])->name('etablissement.liste');
    Route::post('/add',  [EtablissementController::class, 'add'])->name('etablissement.add');
    Route::get('/edit/{id}',  [EtablissementController::class, 'edit'])->name('etablissement.edit');
    Route::post('/edit/{id}',  [EtablissementController::class, 'update'])->name('etablissement.edit.submit');
    Route::get('/delete/{id}',  [EtablissementController::class, 'delete'])->name('etablissement.delete');
});

//responsable
Route::prefix('responsable')->group(function() {
    Route::get('/',  [ResponsableController::class, 'responsable'])->name('responsable.liste');
    Route::post('/add',  [ResponsableController::class, 'add'])->name('responsable.add');
    Route::get('/edit/{id}',  [ResponsableController::class, 'edit'])->name('responsable.edit');
    Route::post('/edit/{id}',  [ResponsableController::class, 'update'])->name('responsable.edit.submit');
    Route::get('/delete/{id}',  [ResponsableController::class, 'delete'])->name('responsable.delete');
});

//enseignant
Route::prefix('enseignant')->group(function() {
    Route::get('/',  [EnseignantController::class, 'enseignant'])->name('enseignant.liste');
    Route::get('/add',  [EnseignantController::class, 'form_add'])->name('enseignant.form_add');
    Route::post('/add',  [EnseignantController::class, 'add'])->name('enseignant.add');
    Route::get('/edit/{id}',  [EnseignantController::class, 'edit'])->name('enseignant.edit');
    Route::post('/edit/{id}',  [EnseignantController::class, 'update'])->name('enseignant.edit.submit');
    Route::get('/delete/{id}',  [EnseignantController::class, 'delete'])->name('enseignant.delete');
    Route::post('/search',  [EnseignantController::class, 'search'])->name('enseignant.search');
    Route::get('/print',  [EnseignantController::class, 'print'])->name('enseignant.print');
    Route::post('/print_c',  [EnseignantController::class, 'print_c'])->name('enseignant.print_c');
});

//dossier
Route::prefix('dossier')->group(function() {
    Route::get('/',  [DossierController::class, 'dossier'])->name('dossier.liste');
    Route::post('/add',  [DossierController::class, 'add'])->name('dossier.add');
    Route::get('/edit/{id}',  [DossierController::class, 'edit'])->name('dossier.edit');
    Route::post('/edit/{id}',  [DossierController::class, 'update'])->name('dossier.edit.submit');
    Route::get('/delete/{id}',  [DossierController::class, 'delete'])->name('dossier.delete');
});
//traitement
Route::prefix('traitement')->group(function() {
    Route::get('/',  [TraitementController::class, 'liste'])->name('traitement.liste');
    Route::get('/deposer/{id}',  [TraitementController::class, 'deposer'])->name('traitement.deposer');
    Route::post('/add',  [TraitementController::class, 'add'])->name('traitement.add');
    Route::get('/transfer/{id}',  [TraitementController::class, 'transfer'])->name('traitement.transfer');
    Route::post('/transfer/{id}',  [TraitementController::class, 'transfert_update'])->name('traitement.transfert_update');
    Route::get('/edit/{id}',  [TraitementController::class, 'edit'])->name('traitement.edit');
    Route::post('/edit/{id}',  [TraitementController::class, 'update'])->name('traitement.update');
    Route::get('/print/{id}',  [TraitementController::class, 'print'])->name('traitement.print');
    Route::get('/rejeter',  [TraitementController::class, 'rejeter'])->name('traitement.rejeter');
    Route::get('/accepter',  [TraitementController::class, 'accepter'])->name('traitement.accepter');
    Route::get('/attente',  [TraitementController::class, 'attente'])->name('traitement.attente');
    Route::get('/rejeter_par_finance',  [TraitementController::class, 'rejeter_par_finance'])->name('traitement.rejeter_par_finance');
    Route::get('/rejeter_par_visa',  [TraitementController::class, 'rejeter_par_visa'])->name('traitement.rejeter_par_visa');
    Route::post('/search',  [TraitementController::class, 'search'])->name('traitement.search');
    Route::post('/search_date',  [TraitementController::class, 'search_date'])->name('traitement.search_date');

});

