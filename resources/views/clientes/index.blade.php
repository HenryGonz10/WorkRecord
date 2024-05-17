@php
    $history = [
        ['name' => __('Dashboard'), 'link' => route('dashboard.index')],
        ['name' => __('Clients'), 'link' => null],
    ];
    //$table = view('components.table', ['headers' => $headers, 'data' => $clients])->render();
@endphp

<form id="deleteClientForm">
    @csrf
</form>

<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <!-- Mostrar el breadcrumb solo en pantallas mayores que sm -->
            <div class="hidden md:block">
                <x-breadcrumb :items="$history" />
            </div>

            <!-- Alinear el h2 hacia la derecha -->
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Clients') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-7">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <x-card>
                <x-slot name="body">
                    <livewire:table-clientes :headers="['Codigo', 'Empresa', 'Cliente', 'Email']" :show-search="true" :show-pagination="true" :visible-columns="['Codigo', 'Empresa', 'Cliente', 'Email']"
                        :has-actions-column="true" />
                </x-slot>
            </x-card>
            <!-- Botón fijo en la esquina inferior derecha -->
            <a class="fixed bottom-8 right-8 bg-blue-500 text-white rounded-full hover:bg-blue-600 transition ease-in-out duration-200"
                href="{{ route('clientes.add') }}">
                <i class="fa-solid fa-plus fa-2x m-4"></i>
            </a>
        </div>
    </div>
</x-app-layout>
