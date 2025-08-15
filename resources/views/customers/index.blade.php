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

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Customers') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-end mb-4">
                    <a href="{{ route('customers.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Add Customer</a>
                </div>
                <table class="min-w-full">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 text-left">Name</th>
                            <th class="px-4 py-2 text-left">Email</th>
                            <th class="px-4 py-2 text-left">Phone</th>
                            <th class="px-4 py-2 text-left">Status</th>
                            <th class="px-4 py-2 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($customers as $customer)
                            <tr>
                                <td class="px-4 py-2">{{ $customer->name }}</td>
                                <td class="px-4 py-2">{{ $customer->email }}</td>
                                <td class="px-4 py-2">{{ $customer->phone }}</td>

                                <!-- Status Column with Toggle -->  
                                <td class="px-4 py-2">
                                    <form action="{{ route('customers.status', $customer) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <select id ="status" name="status" class="border rounded w-full px-3 py-2" onchange="this.form.submit()">
                                            <option value="active" {{ $customer->status == 'active' ? 'selected' : '' }}>Active</option>
                                            <option value="inactive" {{ $customer->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                    </form>
                                </td>
                                
                
                                <td class="px-4 py-2">
                                    <a href="{{ route('customers.edit', $customer) }}" class="text-blue-600 mr-2">Edit</a>
                                    <form action="{{ route('customers.destroy', $customer) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600" onclick="return confirm('Delete this customer?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-2 text-center">No customers found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>