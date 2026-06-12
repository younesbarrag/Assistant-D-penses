<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Mes Reçus
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-4">
                <a href="{{ route('recus.create') }}"
                   class="bg-blue-500 text-white px-4 py-2 rounded">
                    Nouveau reçu
                </a>
            </div>

            <div class="bg-white shadow rounded p-4">
                <table class="w-full border">
                    <thead>
                        <tr>
                            <th class="border p-2">ID</th>
                            <th class="border p-2">Statut</th>
                            <th class="border p-2">Dépenses</th>
                            <th class="border p-2">Date</th>
                            <th class="border p-2">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($recus as $recu)
                            <tr>
                                <td class="border p-2">
                                    {{ $recu->id }}
                                </td>

                                <td class="border p-2">
                                    {{ $recu->statut->value }}
                                </td>

                                <td class="border p-2">
                                    {{ $recu->depenses_count }}
                                </td>

                                <td class="border p-2">
                                    {{ $recu->created_at->format('d/m/Y H:i') }}
                                </td>

                                <td class="border p-2">
                                    <a href="{{ route('recus.show', $recu) }}"
                                       class="text-blue-600">
                                        Voir
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="border p-4 text-center">
                                    Aucun reçu trouvé.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $recus->links() }}
                </div>
            </div>

        </div>
    </div>
</x-app-layout>