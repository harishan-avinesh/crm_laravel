<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proposal;
use App\Models\Customer;

class ProposalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $proposals = Proposal::with('customer')->get();
        return view('proposals.index', compact('proposals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = Customer::where('status', 'active')->get();
        return view('proposals.create', compact('customers'));
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
            'status' => 'required|in:pending,approved,rejected',
        ]);

        Proposal::create($validated);

        return redirect()->route('proposals.index')
            ->with('success', 'Proposal created successfully!');
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
        $proposal = Proposal::findOrFail($id);
        $customers = Customer::where('status', 'active')->get();
        return view('proposals.edit', compact('proposal', 'customers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $proposal = Proposal::findOrFail($id);
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'amount' => 'required|numeric|min:0',
            'customer_id' => 'required|exists:customers,id',
            'status' => 'required|in:pending,approved,rejected',
        ]);

        $proposal->update($validated);

        return redirect()->route('proposals.index')
            ->with('success', 'Proposal updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $proposal = Proposal::findOrFail($id);
        $proposal->delete();

        return redirect()->route('proposals.index')
            ->with('success', 'Proposal deleted successfully!');
    }

    public function changeStatus(Request $request, string $id)
    {
        $proposal = Proposal::findOrFail($id);
        
        $validated = $request->validate([
            'status' => 'required|in:pending,approved,rejected'
        ]);
        
        $proposal->update($validated);

        return redirect()->route('proposals.index')
            ->with('success', 'Proposal status updated to ' . $validated['status'] . '!');
    }
}
