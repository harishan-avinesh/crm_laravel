<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Transaction;

class PaymentController extends Controller
{
    public function createCheckoutSession($invoiceId)
    {
        $invoice = Invoice::with('customer')->findOrFail($invoiceId);

        // Check if Stripe keys exist
        if (!env('STRIPE_SECRET')) {
            return "Please add STRIPE_SECRET to your .env file";
        }

        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            $session = \Stripe\Checkout\Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => $invoice->title,
                            'description' => $invoice->description,
                        ],
                        'unit_amount' => $invoice->amount * 100, // Convert to cents
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => route('payment.success', $invoice->id) . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('payment.cancel', $invoice->id),
                'metadata' => [
                    'invoice_id' => $invoice->id,
                    'customer_id' => $invoice->customer_id,
                ]
            ]);

            // Redirect to Stripe checkout
            return redirect($session->url);
            
        } catch (\Exception $e) {
            return "Stripe Error: " . $e->getMessage();
        }
    }

    public function success($invoiceId, Request $request)
    {
        $invoice = Invoice::findOrFail($invoiceId);
        $sessionId = $request->get('session_id');

        if ($sessionId) {
            \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            
            try {
                $session = \Stripe\Checkout\Session::retrieve($sessionId);
                
                if ($session->payment_status === 'paid') {
                    // Create transaction record
                    Transaction::create([
                        'transaction_number' => 'TXN-' . time(),
                        'invoice_id' => $invoice->id,
                        'customer_id' => $invoice->customer_id,
                        'amount' => $session->amount_total / 100,
                        'payment_method' => 'stripe',
                        'payment_date' => now(),
                        'status' => 'success',
                        'stripe_payment_id' => $session->payment_intent,
                    ]);

                    // Update invoice status
                    $invoice->update(['status' => 'paid']);
                }
            } catch (\Exception $e) {
                // Continue to success page even if verification fails
            }
        }

        return view('payment.success', compact('invoice'));
    }

    public function cancel($invoiceId)
    {
        $invoice = Invoice::findOrFail($invoiceId);
        return view('payment.cancel', compact('invoice'));
    }
}
