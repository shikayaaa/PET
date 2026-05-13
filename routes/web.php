<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PetController;
use App\Http\Controllers\ShelterController;
use App\Http\Controllers\AdoptionApplicationController;
use App\Http\Controllers\AdoptionRecordController;
use App\Http\Controllers\PetMedicalRecordController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('pets', PetController::class);
Route::resource('shelters', ShelterController::class);
Route::resource('adoption-applications', AdoptionApplicationController::class);
Route::resource('adoption-records', AdoptionRecordController::class);
Route::resource('medical-records', PetMedicalRecordController::class);