<?php

use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Route;

Route::controller(ApiController::class)->group(function(){
    # Create olsaydı Resource Controller olacaktı

    Route::get('index', 'index');
    Route::post('store', 'store');
    Route::get('show/{id}', 'show');
    Route::put('update/{id}', 'update');
    Route::delete('destroy/{id}', 'destroy');
});