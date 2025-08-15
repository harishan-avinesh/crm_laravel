<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProposalController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\PaymentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/pay/{invoice}', [PaymentController::class, 'createCheckoutSession'])->name('payment.stripe');
Route::get('/payment/success/{invoice}', [PaymentController::class, 'success'])->name('payment.success');
Route::get('/payment/cancel/{invoice}', [PaymentController::class, 'cancel'])->name('payment.cancel');
Route::post('/stripe/webhook', [PaymentController::class, 'webhook'])->name('stripe.webhook');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //CUSTOMERS CRUD
    Route::resource('customers', CustomerController::class);
    Route::patch('customers/{id}/status', [CustomerController::class, 'changeStatus'])->name('customers.status');

    //PROPOSALS CRUD
    Route::resource('proposals', ProposalController::class);
    Route::patch('proposals/{id}/status', [ProposalController::class, 'changeStatus'])->name('proposals.status');

    //INVOICES CRUD
    Route::resource('invoices', InvoiceController::class);
    Route::patch('invoices/{id}/status', [InvoiceController::class, 'changeStatus'])->name('invoices.status');
    Route::post('invoices/{id}/send', [InvoiceController::class, 'sendInvoice'])->name('invoices.send');

    //TRANSACTIONS
    Route::resource('transactions', TransactionController::class)->only(['index']);
    Route::patch('transactions/{id}/status', [TransactionController::class, 'changeStatus'])->name('transactions.status');
});




require __DIR__.'/auth.php';
