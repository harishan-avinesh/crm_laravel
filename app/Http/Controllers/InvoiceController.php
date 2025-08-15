<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Customer;
use Illuminate\Support\Facades\Mail;
use App\Mail\InvoiceMail;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $invoices = Invoice::with('customer')->get();
        return view('invoices.index', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = Customer::where('status', 'active')->get();
        return view('invoices.create', compact('customers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'amount' => 'required|numeric|min:0',
            'customer_id' => 'required|exists:customers,id',
            'due_date' => 'required|date',
            'status' => 'required|in:pending,paid,cancelled',
        ]);
        
        $validated['invoice_number'] = 'INV-' . time();

        $invoice = Invoice::create($validated);


        try {
            $paymentUrl = route('payment.stripe', $invoice->id);
            Mail::to($invoice->customer->email)->send(new InvoiceMail($invoice, $paymentUrl));
            
            return redirect()->route('invoices.index')
                ->with('success', 'Invoice created and email sent successfully to ' . $invoice->customer->email . '!');
        } catch (\Exception $e) {
            return redirect()->route('invoices.index')
                ->with('success', 'Invoice created successfully, but email failed to send.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $invoice = Invoice::findOrFail($id);
        $customers = Customer::where('status', 'active')->get();
        return view('invoices.edit', compact('invoice', 'customers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $invoice = Invoice::findOrFail($id);
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'amount' => 'required|numeric|min:0',
            'customer_id' => 'required|exists:customers,id',
            'due_date' => 'required|date',
            'status' => 'required|in:pending,paid,cancelled',
        ]);

        $invoice->update($validated);

        return redirect()->route('invoices.index')
            ->with('success', 'Invoice updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $invoice = Invoice::findOrFail($id);
        $invoice->delete();

        return redirect()->route('invoices.index')
            ->with('success', 'Invoice deleted successfully!');
    }

    public function changeStatus(Request $request, string $id)
    {
        $invoice = Invoice::findOrFail($id);
        
        $validated = $request->validate([
            'status' => 'required|in:pending,paid,cancelled'
        ]);
        
        $invoice->update($validated);

        return redirect()->route('invoices.index')
            ->with('success', 'Invoice status updated to ' . $validated['status'] . '!');
    }

    public function sendInvoice(string $id)
    {
        $invoice = Invoice::findOrFail($id);
        
        // TODO: Implement email sending with payment link
        // We'll add this functionality later
        
        return redirect()->route('invoices.index')
            ->with('success', 'Invoice sent to ' . $invoice->customer->name . '!');
    }
}
