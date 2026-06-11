<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RecuController;

Route::middleware('auth')->group(function () {

    Route::get('/recus', [RecuController::class, 'index'])->name('recus.index');

    Route::get('/recus/create', [RecuController::class, 'create'])->name('recus.create');

    Route::post('/recus', [RecuController::class, 'store'])->name('recus.store');

    Route::get('/recus/{recu}', [RecuController::class, 'show'])->name('recus.show');

    Route::delete('/recus/{recu}', [RecuController::class, 'destroy'])->name('recus.destroy');
});
