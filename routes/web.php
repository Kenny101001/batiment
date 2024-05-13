<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('choix');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/choix', [App\Http\Controllers\loginController::class, 'choix'])->name('choix');
Route::get('/login', [App\Http\Controllers\loginController::class, 'login'])->name('login');
Route::get('/logout', [App\Http\Controllers\loginController::class, 'logout'])->name('logout');
Route::post('/loginVerif', [App\Http\Controllers\loginController::class, 'loginVerif'])->name('loginVerif');

Route::get('/loginclient', [App\Http\Controllers\loginController::class, 'loginclient'])->name('loginclient');
Route::get('/logoutclient', [App\Http\Controllers\loginController::class, 'logoutclient'])->name('logoutclient');


Route::get('/mdp', [App\Http\Controllers\loginController::class, 'mdp'])->name('mdp');
Route::post('/mdpUpdate', [App\Http\Controllers\loginController::class, 'mdpUpdate'])->name('mdpUpdate');


Route::get('/inscription', [App\Http\Controllers\LoginController::class, 'inscription'])->name('inscription');
Route::post('/ajoutUtilisateur', [App\Http\Controllers\LoginController::class, 'ajoutUtilisateur'])->name('ajoutUtilisateur');

Route::post('/validerformulaire', [App\Http\Controllers\LoginController::class, 'validerformulaire']);


Route::get('/indexAdmin', [App\Http\Controllers\AdminController::class, 'index'])->name('indexAdmin');


Route::get('/indexClient', [App\Http\Controllers\ClientController::class, 'index'])->name('indexClient');

