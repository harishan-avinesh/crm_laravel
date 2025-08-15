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
                        <div class="text-2xl font-bold text-gray-900">{{ $totalCustomers }}</div>
                        <div class="text-sm text-gray-600">Total Customers</div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-center">
                        <div class="text-3xl text-green-600 mb-2">📋</div>
                        <div class="text-2xl font-bold text-gray-900">{{ $totalProposals }}</div>
                        <div class="text-sm text-gray-600">Total Proposals</div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-center">
                        <div class="text-3xl text-yellow-600 mb-2">🧾</div>
                        <div class="text-2xl font-bold text-gray-900">{{ $totalInvoices }}</div>
                        <div class="text-sm text-gray-600">Total Invoices</div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-center">
                        <div class="text-3xl text-purple-600 mb-2">💳</div>
                        <div class="text-2xl font-bold text-gray-900">{{ $totalTransactions }}</div>
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
                           class="flex items-center justify-center px-4 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200">
                            👤 Add Customer
                        </a>
                        
                        <a href="{{ route('proposals.create') }}" 
                           class="flex items-center justify-center px-4 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition duration-200">
                            📋 Create Proposal
                        </a>
                        
                        <a href="{{ route('invoices.create') }}" 
                           class="flex items-center justify-center px-4 py-3 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700 transition duration-200">
                            🧾 Create Invoice
                        </a>
                        
                        <a href="{{ route('transactions.index') }}" 
                           class="flex items-center justify-center px-4 py-3 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition duration-200">
                            💳 View Transactions
                        </a>
                    </div>
                </div>
            </div>

            <!-- Navigation Cards -->
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
