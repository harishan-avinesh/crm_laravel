<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-center">
                        <div class="text-3xl text-blue-600 mb-2">👤</div>
                        <div class="text-2xl font-bold text-gray-900">{{ $totalCustomers ?? 0 }}</div>
                        <div class="text-sm text-gray-600">Total Customers</div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-center">
                        <div class="text-3xl text-green-600 mb-2">📋</div>
                        <div class="text-2xl font-bold text-gray-900">{{ $totalProposals ?? 0 }}</div>
                        <div class="text-sm text-gray-600">Total Proposals</div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-center">
                        <div class="text-3xl text-yellow-600 mb-2">🧾</div>
                        <div class="text-2xl font-bold text-gray-900">{{ $totalInvoices ?? 0 }}</div>
                        <div class="text-sm text-gray-600">Total Invoices</div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-center">
                        <div class="text-3xl text-purple-600 mb-2">💳</div>
                        <div class="text-2xl font-bold text-gray-900">{{ $totalTransactions ?? 0 }}</div>
                        <div class="text-sm text-gray-600">Total Transactions</div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h3>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <a href="{{ route('customers.create') }}" 
                           class="flex items-center justify-center px-4 py-3 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            👤 Add Customer
                        </a>
                        
                        <a href="{{ route('proposals.create') }}" 
                           class="flex items-center justify-center px-4 py-3 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            📋 Create Proposal
                        </a>
                        
                        <a href="{{ route('invoices.create') }}" 
                           class="flex items-center justify-center px-4 py-3 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-700 focus:bg-yellow-700 active:bg-yellow-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            🧾 Create Invoice
                        </a>
                        
                        <a href="{{ route('transactions.index') }}" 
                           class="flex items-center justify-center px-4 py-3 bg-purple-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-purple-700 focus:bg-purple-700 active:bg-purple-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            💳 View Transactions
                        </a>
                    </div>
                </div>
            </div>

            <!-- Navigation Links -->
            <div class="mt-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h4 class="font-semibold text-gray-900 mb-2">Customers</h4>
                        <p class="text-sm text-gray-600 mb-4">Manage your customer database</p>
                        <a href="{{ route('customers.index') }}" class="text-blue-600 hover:underline">View All →</a>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h4 class="font-semibold text-gray-900 mb-2">Proposals</h4>
                        <p class="text-sm text-gray-600 mb-4">Track proposal status</p>
                        <a href="{{ route('proposals.index') }}" class="text-green-600 hover:underline">View All →</a>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h4 class="font-semibold text-gray-900 mb-2">Invoices</h4>
                        <p class="text-sm text-gray-600 mb-4">Manage invoices and payments</p>
                        <a href="{{ route('invoices.index') }}" class="text-yellow-600 hover:underline">View All →</a>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h4 class="font-semibold text-gray-900 mb-2">Transactions</h4>
                        <p class="text-sm text-gray-600 mb-4">View payment history</p>
                        <a href="{{ route('transactions.index') }}" class="text-purple-600 hover:underline">View All →</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
