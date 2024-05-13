<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('choix');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/choix', [App\Http\Controllers\loginController::class, 'choix'])->name('choix');
Route::get('/login', [App\Http\Controllers\loginController::class, 'login'])->name('login');
Route::get('/logout', [App\Http\Controllers\loginController::class, 'logout'])->name('logout');
Route::get('/loginVerify', [App\Http\Controllers\loginController::class, 'loginVerify'])->name('loginVerify');

Route::get('/mdp', [App\Http\Controllers\loginController::class, 'mdp'])->name('mdp');
Route::post('/mdpUpdate', [App\Http\Controllers\loginController::class, 'mdpUpdate'])->name('mdpUpdate');

Route::get('/inscription', [App\Http\Controllers\LoginController::class, 'inscription'])->name('inscription');
Route::post('/ajoutUtilisateur', [App\Http\Controllers\LoginController::class, 'ajoutUtilisateur'])->name('ajoutUtilisateur');

Route::post('/validerformulaire', [App\Http\Controllers\LoginController::class, 'validerformulaire']);


Route::get('/indexAdmin', [App\Http\Controllers\AdminController::class, 'index'])->name('indexAdmin');
Route::get('/detailprojetAdmin', [App\Http\Controllers\AdminController::class, 'detailprojetAdmin'])->name('detailprojetAdmin');
Route::get('/telechargerpdfAdmin', [App\Http\Controllers\AdminController::class, 'telechargerpdfAdmin'])->name('telechargerpdfAdmin');
Route::get('/reinitialiserBase', [App\Http\Controllers\AdminController::class, 'reinitialiserBase'])->name('reinitialiserBase');

Route::get('/indexClient', [App\Http\Controllers\ClientController::class, 'index'])->name('indexClient');
Route::get('/loginclient', [App\Http\Controllers\ClientController::class, 'loginclient'])->name('loginclient');
Route::get('/logoutclient', [App\Http\Controllers\ClientController::class, 'logoutclient'])->name('logoutclient');
Route::post('/connexion', [App\Http\Controllers\ClientController::class, 'connexion'])->name('connexion');
Route::get('/offre', [App\Http\Controllers\ClientController::class, 'offre'])->name('offre');
Route::post('/DeviAjouter', [App\Http\Controllers\ClientController::class, 'DeviAjouter'])->name('DeviAjouter');
Route::get('/projet', [App\Http\Controllers\ClientController::class, 'projet'])->name('projet');
Route::get('/detailprojet', [App\Http\Controllers\ClientController::class, 'detailprojet'])->name('detailprojet');
Route::get('/telechargerpdf', [App\Http\Controllers\ClientController::class, 'telechargerpdf'])->name('telechargerpdf');
Route::post('/versement', [App\Http\Controllers\ClientController::class, 'versement'])->name('versement');
