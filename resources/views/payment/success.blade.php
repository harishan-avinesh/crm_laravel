<x-app-layout>
    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-center">
                <div class="text-green-600 text-6xl mb-4">✓</div>
                <h2 class="text-2xl font-bold text-green-600 mb-4">Payment Successful!</h2>
                <p class="text-gray-600 mb-4">Thank you for your payment.</p>
                <div class="bg-gray-50 p-4 rounded">
                    <p><strong>Invoice:</strong> {{ $invoice->invoice_number }}</p>
                    <p><strong>Amount:</strong> ${{ number_format($invoice->amount, 2) }}</p>
                    <p><strong>Status:</strong> {{ ucfirst($invoice->status) }}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>