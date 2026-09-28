<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Dashboard do Coach
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    Área do Coach
                </div>
            </div>
        </div>
    </div>
    <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <h3 class="text-lg font-semibold">
            {{ $assessoria->name }}
        </h3>

        <p class="mt-2">
            Atletas acompanhados: {{ $atletas->count() }}
        </p>

        <div class="mt-4">
        @foreach ($atletas as $atleta)
            <p>
                <a
                    href="{{ route('coach.athlete', $atleta) }}"
                    class="text-blue-500 hover:underline"
                >
                    {{ $atleta->name }}
                </a>
            </p>
        @endforeach
        </div>

    </div>
</div>
</x-app-layout>