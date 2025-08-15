<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Invoices') }}
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
                <div class="flex justify-end mb-4">
                    <a href="{{ route('invoices.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Add Invoice</a>
                </div>

                <table class="min-w-full">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 text-left">Invoice #</th>
                            <th class="px-4 py-2 text-left">Title</th>
                            <th class="px-4 py-2 text-left">Customer</th>
                            <th class="px-4 py-2 text-left">Amount</th>
                            <th class="px-4 py-2 text-left">Due Date</th>
                            <th class="px-4 py-2 text-left">Status</th>
                            <th class="px-4 py-2 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($invoices as $invoice)
                            <tr>
                                <td class="px-4 py-2">{{ $invoice->invoice_number }}</td>
                                <td class="px-4 py-2">{{ $invoice->title }}</td>
                                <td class="px-4 py-2">{{ $invoice->customer->name }}</td>
                                <td class="px-4 py-2">${{ number_format($invoice->amount, 2) }}</td>
                                <td class="px-4 py-2">{{ $invoice->due_date->format('M d, Y') }}</td>
                                
                                <td class="px-4 py-2">
                                    <form action="{{ route('invoices.status', $invoice) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status" class="border rounded px-2 py-1" onchange="this.form.submit()">
                                            <option value="pending" {{ $invoice->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="paid" {{ $invoice->status == 'paid' ? 'selected' : '' }}>Paid</option>
                                            <option value="cancelled" {{ $invoice->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                        </select>
                                    </form>
                                </td>
                                
                                <td class="px-4 py-2">
                                    <a href="{{ route('invoices.edit', $invoice) }}" class="text-blue-600 mr-2">Edit</a>
                                    
                                    <form action="{{ route('invoices.destroy', $invoice) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600" onclick="return confirm('Delete this invoice?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-4 py-2 text-center">No invoices found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>