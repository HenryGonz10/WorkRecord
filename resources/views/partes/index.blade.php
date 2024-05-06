@php
    $history = [
        ['name' => __('Dashboard'), 'link' => route('dashboard.index')],
        ['name' => __('Work records'), 'link' => null],
    ];
    $table = view('components.table', ['headers' => $headers, 'data' => $clients])->render();
@endphp

<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <!-- Mostrar el breadcrumb solo en pantallas mayores que sm -->
            <div class="hidden md:block">
                <x-breadcrumb :items="$history" />
            </div>

            <!-- Alinear el h2 hacia la derecha -->
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Work records') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-7">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <x-card body="{!! $table !!}" />
            <!-- Botón fijo en la esquina inferior derecha -->
            <a class="fixed bottom-8 right-8 bg-blue-500 text-white rounded-full hover:bg-blue-600 transition ease-in-out duration-200"
                href="{{ route('partes.add') }}">
                <i class="fa-solid fa-plus fa-2x m-4"></i>
            </a>
        </div>
    </div>
</x-app-layout>
