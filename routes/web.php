<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\BusinessProfileController;
use App\Http\Controllers\CreateClientController;
use App\Http\Controllers\invoiceController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.index');
});

Route::middleware(['auth', 'verified'])->group(function() {
    Route::view('/dashboard', 'pages.dashboard')->name('pages.dashboard');
    Route::get('/clients', [CreateClientController::class, 'fetchClients']);
    Route::view('/invoices', 'pages.invoices');
    Route::get('/invoices/create', [invoiceController::class, 'getClientsAndBusinesses']);
    Route::view('/settings', 'pages.settings');
});


Route::middleware(['auth', 'verified'])->group(function() {
    Route::post('/business/create-business-profile', [BusinessProfileController::class, 'createBusiness']);
    Route::post('/client/create-client', [CreateClientController::class, 'createClient']);
    Route::post('/invoices/create', [invoiceController::class, 'createInvoice']);

});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
