<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Customer') }}
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

                <form method="POST" action="{{ route('customers.update', $customer) }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label class="block">Name</label>
                        <input type="text" name="name" value="{{ $customer->name }}" class="border rounded w-full px-3 py-2" required>
                    </div>
                    <div class="mb-4">
                        <label class="block">Email</label>
                        <input type="email" name="email" value="{{ $customer->email }}" class="border rounded w-full px-3 py-2" required>
                    </div>
                    <div class="mb-4">
                        <label class="block">Phone</label>
                        <input type="text" name="phone" value="{{ $customer->phone }}" class="border rounded w-full px-3 py-2">
                    </div>
                    <div class="mb-4">
                        <label class="block">Address</label>
                        <input type="text" name="address" value="{{ $customer->address }}" class="border rounded w-full px-3 py-2">
                    </div>
                    <div class="mb-4">
                        <label class="block">Status</label>
                        <select name="status" class="border rounded w-full px-3 py-2">
                            <option value="active" {{ $customer->status == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ $customer->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
                    <a href="{{ route('customers.index') }}" class="ml-2 text-gray-600">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>