<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow rounded p-6">
                <h3 class="text-lg font-semibold mb-4">
                    Assistant Dépenses
                </h3>

                <div class="flex gap-4">
                    <a href="{{ route('recus.index') }}"
                       class="bg-blue-600 text-white px-4 py-2 rounded">
                        Mes reçus
                    </a>

                    <a href="{{ route('recus.create') }}"
                       class="bg-green-600 text-white px-4 py-2 rounded">
                        Nouveau reçu
                    </a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>