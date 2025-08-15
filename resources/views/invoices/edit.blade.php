<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Invoice') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
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

                <form method="POST" action="{{ route('invoices.update', $invoice) }}">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Invoice Number</label>
                        <input type="text" value="{{ $invoice->invoice_number }}" class="border rounded w-full px-3 py-2 bg-gray-100" readonly>
                        <small class="text-gray-500">Invoice number cannot be changed</small>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Title</label>
                        <input type="text" name="title" value="{{ $invoice->title }}" class="border rounded w-full px-3 py-2" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Customer</label>
                        <select name="customer_id" class="border rounded w-full px-3 py-2" required>
                            <option value="">Select Customer</option>
                            @foreach($customers as $customer)
                                <option value="{{ $customer->id }}" {{ $invoice->customer_id == $customer->id ? 'selected' : '' }}>
                                    {{ $customer->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea name="description" rows="4" class="border rounded w-full px-3 py-2" required>{{ $invoice->description }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Amount ($)</label>
                        <input type="number" name="amount" value="{{ $invoice->amount }}" step="0.01" min="0" class="border rounded w-full px-3 py-2" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Due Date</label>
                        <input type="date" name="due_date" value="{{ $invoice->due_date->format('Y-m-d') }}" class="border rounded w-full px-3 py-2" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Status</label>
                        <select name="status" class="border rounded w-full px-3 py-2">
                            <option value="pending" {{ $invoice->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="paid" {{ $invoice->status == 'paid' ? 'selected' : '' }}>Paid</option>
                            <option value="cancelled" {{ $invoice->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>

                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update Invoice</button>
                    <a href="{{ route('invoices.index') }}" class="ml-2 text-gray-600">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>