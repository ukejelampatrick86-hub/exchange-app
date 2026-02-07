<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Test des Boutons Personnalisés
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">

            <!-- Boutons -->
            <button class="btn btn-primary">
                Bouton Principal
            </button>

            <button class="btn btn-secondary">
                Bouton Secondaire
            </button>

            <button class="btn btn-danger">
                Supprimer
            </button>

        </div>
    </div>
</x-app-layout>
