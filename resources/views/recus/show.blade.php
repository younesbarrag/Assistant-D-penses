<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Détail du Reçu #{{ $recu->id }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow rounded p-6 mb-6">
                <p><strong>Statut :</strong> {{ $recu->statut->value }}</p>
                <p><strong>Devise :</strong> {{ $recu->devise }}</p>
                <p><strong>Total estimé :</strong> {{ $recu->total_estime ?? 'Non calculé' }}</p>

                <hr class="my-4">

                <h3 class="font-semibold mb-2">Texte source</h3>
                <pre class="bg-gray-100 p-4 rounded whitespace-pre-wrap">{{ $recu->texte_source }}</pre>
            </div>

            <div class="bg-white shadow rounded p-6">
                <h3 class="font-semibold mb-4">Dépenses extraites</h3>

                @if ($recu->depenses->isEmpty())
                    <p>Aucune dépense extraite pour le moment.</p>
                @else
                    <table class="w-full border">
                        <thead>
                            <tr>
                                <th class="border p-2">Libellé</th>
                                <th class="border p-2">Quantité</th>
                                <th class="border p-2">Prix unitaire</th>
                                <th class="border p-2">Catégorie</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($recu->depenses as $depense)
                                <tr>
                                    <td class="border p-2">{{ $depense->libelle }}</td>
                                    <td class="border p-2">{{ $depense->quantite }}</td>
                                    <td class="border p-2">{{ $depense->prix_unitaire }}</td>
                                    <td class="border p-2">{{ $depense->categorie->value }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>

            <div class="mt-4">
                <a href="{{ route('recus.index') }}" class="text-blue-600">
                    Retour à la liste
                </a>
            </div>

        </div>
    </div>
</x-app-layout>