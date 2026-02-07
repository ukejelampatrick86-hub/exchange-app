<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Exemple de Cards
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Card simple -->
            <div class="card">
                <h2 class="card-header">Card Title</h2>
                <div class="card-body">
                    <p>Content here...</p>
                </div>
            </div>

            <!-- Card avec bouton -->
            <div class="card">
                <h2 class="card-header">Transaction</h2>
                <p class="card-body">Détails de la transaction ici</p>
                <a href="#" class="btn btn-primary mt-2">View</a> <!-- mt-2 = marge en haut -->
            </div>

        </div>
    </div>
</x-app-layout>
