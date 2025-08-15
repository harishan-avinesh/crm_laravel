<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;

class TransactionController extends Controller
{
    // Only index method - read-only view of all transactions
    public function index()
    {
        $transactions = Transaction::with(['invoice', 'customer'])
            ->orderBy('created_at', 'desc')
            ->get();
        return view('transactions.index', compact('transactions'));
    }

    // Keep this helper method for Stripe webhook later
    public static function createFromStripe($invoiceId, $stripePaymentData)
    {
        return Transaction::create([
            'transaction_number' => 'TXN-' . str_pad(Transaction::count() + 1, 4, '0', STR_PAD_LEFT),
            'invoice_id' => $invoiceId,
            'customer_id' => $stripePaymentData['customer_id'],
            'amount' => $stripePaymentData['amount'] / 100, // Stripe uses cents
            'payment_method' => 'stripe',
            'payment_date' => now(),
            'status' => 'success',
            'stripe_payment_id' => $stripePaymentData['payment_intent_id'],
        ]);
    }
}