<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Customer') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('customers.store') }}">
                    @csrf
                    <div class="mb-4">
                        <label class="block">Name</label>
                        <input type="text" name="name" class="border rounded w-full" required>
                    </div>
                    <div class="mb-4">
                        <label class="block">Email</label>
                        <input type="email" name="email" class="border rounded w-full" required>
                    </div>
                    <div class="mb-4">
                        <label class="block">Phone</label>
                        <input type="text" name="phone" class="border rounded w-full">
                    </div>
                    <div class="mb-4">
                        <label class="block">Address</label>
                        <input type="text" name="address" class="border rounded w-full">
                    </div>
                    <div class="mb-4">
                        <label class="block">Status</label>
                        <select name="status" class="border rounded w-full">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                    <button type="submit" class="bg-blue-500 text-black px-4 py-2 rounded">Save</button>
                    <a href="{{ route('customers.index') }}" class="ml-2 text-black-600">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>