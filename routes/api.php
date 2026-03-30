<?php
    use App\Http\Controllers\BillingController;
    use Illuminate\Support\Facades\Route;

    Route::post('/webhook/paystack', [BillingController::class, 'webHook']);
?>