@php
    $history = [
        ['name' => __('Dashboard'), 'link' => route('dashboard.index')],
        ['name' => __('Clients'), 'link' => route('clientes.index')],
        ['name' => __('Add') . ' ' . __('Clients'), 'link' => null],
    ];
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
                {{ __('Add') . ' ' . __('Clients') }}
            </h2>
        </div>
    </x-slot>
    <x-form-clients action="{{ route('clientes.store') }}" method="POST" />

    @push('scripts')
        @vite(['resources/js/validations-client.js'])
    @endpush
</x-app-layout>
