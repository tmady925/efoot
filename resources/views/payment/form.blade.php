<x-app-layout>
    <div class="max-w-2xl mx-auto py-10">
        <h2 class="text-2xl font-bold mb-4">Paiement requis</h2>

        <form action="{{ route('payment.process') }}" method="POST">
            @csrf
            <p class="mb-4">Un paiement est requis pour accéder au dashboard.</p>

            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">
                Simuler le Paiement ✔️
            </button>
        </form>
    </div>
</x-app-layout>
