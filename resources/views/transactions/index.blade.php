<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Transactions') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div 
                    x-data="{ show: true }" 
                    x-show="show" 
                    x-init="setTimeout(() => show = false, 3000)" 
                    class="mb-4 p-4 bg-green-100 text-green-800 rounded"
                >
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <table class="min-w-full">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 text-left">Transaction #</th>
                            <th class="px-4 py-2 text-left">Invoice #</th>
                            <th class="px-4 py-2 text-left">Customer</th>
                            <th class="px-4 py-2 text-left">Amount</th>
                            <th class="px-4 py-2 text-left">Payment Method</th>
                            <th class="px-4 py-2 text-left">Payment Date</th>
                            <th class="px-4 py-2 text-left">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transactions as $transaction)
                            <tr>
                                <td class="px-4 py-2">{{ $transaction->transaction_number }}</td>
                                <td class="px-4 py-2">{{ $transaction->invoice->invoice_number }}</td>
                                <td class="px-4 py-2">{{ $transaction->customer->name }}</td>
                                <td class="px-4 py-2">${{ number_format($transaction->amount, 2) }}</td>
                                <td class="px-4 py-2">{{ ucwords(str_replace('_', ' ', $transaction->payment_method)) }}</td>
                                <td class="px-4 py-2">{{ $transaction->payment_date->format('M d, Y') }}</td>
                                
                                <td class="px-4 py-2">
                                    <span class="px-2 py-1 rounded text-sm {{ $transaction->status == 'success' ? 'bg-green-100 text-green-800' : ($transaction->status == 'failed' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                        {{ ucfirst($transaction->status) }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-4 py-2 text-center text-gray-500">
                                    No transactions found. Transactions are automatically created when customers make payments.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>