<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Proposal;
use App\Models\Invoice;
use App\Models\Transaction;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'totalCustomers' => Customer::count(),
            'totalProposals' => Proposal::count(),
            'totalInvoices' => Invoice::count(),
            'totalTransactions' => Transaction::count()
        ]);
    }
}
