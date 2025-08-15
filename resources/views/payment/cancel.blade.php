<x-app-layout>
    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-center">
                <div class="text-red-600 text-6xl mb-4">✗</div>
                <h2 class="text-2xl font-bold text-red-600 mb-4">Payment Cancelled</h2>
                <p class="text-gray-600 mb-4">Your payment was cancelled. You can try again anytime.</p>
                <div class="bg-gray-50 p-4 rounded">
                    <p><strong>Invoice:</strong> {{ $invoice->invoice_number }}</p>
                    <p><strong>Amount:</strong> ${{ number_format($invoice->amount, 2) }}</p>
                </div>
                <a href="{{ route('payment.stripe', $invoice->id) }}" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded">Try Again</a>
            </div>
        </div>
    </div>
</x-app-layout>