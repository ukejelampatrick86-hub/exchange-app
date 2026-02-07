<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Test des Couleurs Personnalisées
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Card -->
            <div class="bg-graybg p-6 rounded shadow">
                Card avec fond gris clair
            </div>

            <!-- Bouton principal -->
            <button class="bg-primary text-white px-4 py-2 rounded hover:bg-secondary">
                Bouton Principal
            </button>

            <!-- Bouton danger -->
            <button class="bg-danger text-white px-4 py-2 rounded hover:bg-red-700">
                Supprimer
            </button>

            <!-- Texte -->
            <p class="text-text-primary">Texte principal sombre</p>
            <p class="text-text-secondary">Texte secondaire gris</p>

        </div>
    </div>
</x-app-layout>
