<?php

use App\Http\Controllers\UserAgentController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('agents/{user}', [UserAgentController::class, 'store'])->name('agents.store');
});
