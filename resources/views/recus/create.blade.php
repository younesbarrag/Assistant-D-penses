<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Nouveau Reçu
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow rounded p-6">

                <form method="POST" action="{{ route('recus.store') }}">
                    @csrf

                    <div class="mb-4">
                        <label
                            for="texte_source"
                            class="block text-sm font-medium text-gray-700"
                        >
                            Texte du reçu
                        </label>

                        <textarea
                            id="texte_source"
                            name="texte_source"
                            rows="10"
                            class="mt-1 block w-full rounded border-gray-300 shadow-sm"
                        >{{ old('texte_source') }}</textarea>

                        @error('texte_source')
                            <p class="text-red-500 text-sm mt-2">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="flex gap-3">
                        <button
                            type="submit"
                            class="bg-blue-600 text-white px-4 py-2 rounded"
                        >
                            Analyser le reçu
                        </button>

                        <a
                            href="{{ route('recus.index') }}"
                            class="bg-gray-500 text-white px-4 py-2 rounded"
                        >
                            Retour
                        </a>
                    </div>

                </form>

            </div>

        </div>
    </div>
</x-app-layout>