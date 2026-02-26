<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\BusinessProfileController;
use App\Http\Controllers\CreateClientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\invoiceController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.index');
});

Route::get('/invoices/{invoice}/pdf-view', [InvoiceController::class, 'pdfView'])
    ->name('invoices.pdf.view')
    ->middleware('signed'); 

Route::middleware(['auth', 'verified'])->group(function() {
    Route::get('/dashboard', [DashboardController::class, 'fetchInvoices'])->name('pages.dashboard');

    Route::get('/clients', [CreateClientController::class, 'fetchClients']);

    Route::get('/invoices', [invoiceController::class, 'fetchInvoices'])->name('invoices.index');

    Route::get('/invoices/show-invoice-{invoice}', [invoiceController::class, 'show'])->name('invoices.show');

    Route::get('/invoices/create', [invoiceController::class, 'getClientsAndBusinesses']);

    Route::get('/invoices/invoice-{invoice}/pdf', [invoiceController::class, 'downloadInvoicePdf'])->name('invoices.pdf');
    
    Route::view('/settings', 'pages.settings');
});


Route::middleware(['auth', 'verified'])->group(function() {
    Route::post('/business/create-business-profile', [BusinessProfileController::class, 'createBusiness']);

    Route::post('/client/create-client', [CreateClientController::class, 'createClient']);

    Route::post('/invoices/create', [invoiceController::class, 'createInvoice'])->name('invoices.create');

    Route::patch('/invoices/update-invoice-{invoice}', [invoiceController::class, 'updateInvoice'])->name('invoices.update');

});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
