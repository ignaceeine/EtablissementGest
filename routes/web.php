<?php

use App\Http\Controllers\ClasseController;
use App\Http\Controllers\CoursController;
use App\Http\Controllers\EmploiDuTempsController;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\ProfesseurController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('classe', [ClasseController::class, 'index'])->name('classe.index');
Route::get('classe/create', [ClasseController::class, 'create'])->name('classe.create');
Route::post('classe/store', [ClasseController::class, 'store'])->name('classe.store');
Route::get('classe/edit/{id}', [ClasseController::class, 'edit'])->name('classe.edit');
Route::post('classe/update', [ClasseController::class, 'update'])->name('classe.update');
Route::delete('classe/destroy/{id}', [ClasseController::class, 'destroy'])->name('classe.destroy');

Route::get('professeur', [ProfesseurController::class, 'index'])->name('professeur.index');
Route::get('professeur/create', [ProfesseurController::class, 'create'])->name('professeur.create');
Route::post('professeur/store', [ProfesseurController::class, 'store'])->name('professeur.store');
Route::get('professeur/edit/{id}', [ProfesseurController::class, 'edit'])->name('professeur.edit');
Route::post('professeur/update', [ProfesseurController::class, 'update'])->name('professeur.update');
Route::delete('professeur/destroy/{id}', [ProfesseurController::class, 'destroy'])->name('professeur.destroy');

Route::get('etudiant', [EtudiantController::class, 'index'])->name('etudiant.index');
Route::get('etudiant/create', [EtudiantController::class, 'create'])->name('etudiant.create');
Route::post('etudiant/store', [EtudiantController::class, 'store'])->name('etudiant.store');
Route::get('etudiant/edit/{id}', [EtudiantController::class, 'edit'])->name('etudiant.edit');
Route::post('etudiant/update', [EtudiantController::class, 'update'])->name('etudiant.update');
Route::delete('etudiant/delete/{id}', [EtudiantController::class, 'destroy'])->name('etudiant.destroy');

Route::get('cours', [CoursController::class, 'index'])->name('cours.index');
Route::get('cours/create', [CoursController::class, 'create'])->name('cours.create');
Route::post('cours/store', [CoursController::class, 'store'])->name('cours.store');
Route::get('cours/edit/{id}', [CoursController::class, 'edit'])->name('cours.edit');
Route::post('cours/update', [CoursController::class, 'update'])->name('cours.update');
Route::delete('cours/delete/{id}', [CoursController::class, 'destroy'])->name('cours.destroy');

Route::get('emploiDuTemps', [EmploiDuTempsController::class, 'index'])->name('emploiDuTemps.index');
Route::get('emploiDuTemps/create', [EmploiDuTempsController::class, 'create'])->name('emploiDuTemps.create');
Route::post('emploiDuTemps/store', [EmploiDuTempsController::class, 'store'])->name('emploiDuTemps.store');
Route::get('emploiDuTemps/edit/{id}', [EmploiDuTempsController::class, 'edit'])->name('emploiDuTemps.edit');
Route::post('emploiDuTemps/update', [EmploiDuTempsController::class, 'update'])->name('emploiDuTemps.update');
Route::delete('emploiDuTemps/delete/{id}', [EmploiDuTempsController::class, 'destroy'])->name('emploiDuTemps.destroy');
