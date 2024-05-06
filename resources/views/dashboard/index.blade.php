@php
    $tablaUltimosRegistros = view('components.table', [
        'headers' => ['Id', 'Codigo', 'Empresa', 'Cliente', 'Total'],
        'data' => $ultimosRegistros,
    ])->render();
    $tablaUltimosClientes = view('components.table', [
        'headers' => ['Id', 'Codigo', 'Empresa', 'Cliente', 'Email'],
        'data' => $ultimosClientes,
    ])->render();
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-7">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden sm:rounded-lg">
                <div class="flex flex-wrap">
                    <x-card-info titulo="{{ __('Clients') }}" texto="{{ $totalClients }}"
                        subtitulo="{{ __('Total Clients') }}"
                        icono='<div class="inline-block w-12 h-12 text-center rounded-full bg-gradient-to-tl from-blue-500 to-blue-700">
                            <i class="fa-solid fa-users text-lg relative top-2.5 text-white"></i>
                        </div>' />
                    <x-card-info titulo="{{ __('Work records') }}" texto="{{ $totalClients }}"
                        subtitulo="{{ __('Total work records') }}"
                        icono='<div class="inline-block w-12 h-12 text-center rounded-full bg-gradient-to-tl from-red-500 to-red-700">
                            <i class="fa-solid fa-list-check text-lg relative top-2.5 text-white"></i>
                        </div>' />
                    <x-card-info titulo="{{ __('Collection') }}" texto="{{ $totalClients }}"
                        subtitulo="{{ __('Total collection') }}"
                        icono='<div class="inline-block w-12 h-12 text-center rounded-full bg-gradient-to-tl from-green-500 to-green-700">
                            <i class="fa-solid fa-money-bill text-lg relative top-2.5 text-white"></i>
                        </div>' />
                    <x-card-info titulo="{{ __('Time working') }}" texto="{{ $totalClients }}"
                        subtitulo="{{ __('Total time working') }}"
                        icono='<div class="inline-block w-12 h-12 text-center rounded-full bg-gradient-to-tl from-orange-500 to-orange-700">
                            <i class="fa-solid fa-business-time text-lg relative top-2.5 text-white"></i>
                        </div>' />
                </div>
                <div class="flex flex-wrap mt-7">
                    <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-2/4">
                        <x-card header="{!! '<h2 class=\'font-extrabold text-lg text-blue-950\'>' . __('Last work records') . '</h2>' !!}" body="{!! $tablaUltimosRegistros !!}" />
                    </div>
                    <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-2/4">
                        <x-card header="<h2 class='font-extrabold text-lg text-blue-950'>{{ __('Last clients') }}</h2>"
                            body="{!! $tablaUltimosClientes !!}" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
