<div>
    @if ($showSearch)
        <div class="relative my-3 rounded-md">
            <div class="mx-2 pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                <span class="text-gray-500 sm:text-sm"><i class="fa-solid fa-magnifying-glass"></i></span>
            </div>
            <input type="text" wire:model.lazy="search" placeholder="{{ __('Search') }}..."
                class="ml-3 rounded-md border-0 py-1.5 pl-7 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
        </div>
    @endif

    @if ($data->isNotEmpty())
        <div class="overflow-x-auto">
            <table class="table-auto w-full text-left border-collapse">
                <thead>
                    <tr>
                        @foreach ($visibleColumns as $header)
                            <th class="px-4 py-2 border-b uppercase text-blue-900 cursor-pointer"
                                wire:click="sortBy('{{ $header }}')">
                                {{ $header }}
                                @if ($sortColumn === $header)
                                    <span>
                                        {{ $sortDirection === 'asc' ? '↑' : '↓' }}
                                    </span>
                                @endif
                            </th>
                        @endforeach
                        @if ($hasActionsColumn)
                            <th class="px-4 py-2 border-b uppercase text-blue-900">
                                Opciones
                            </th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $row)
                        <tr>
                            @foreach ($visibleColumns as $header)
                                <td class="px-4 py-2 border-b text-gray-500">
                                    {{ $row->$header ?? '' }}
                                </td>
                            @endforeach
                            @if ($hasActionsColumn)
                                <td class="px-4 py-2 border-b text-gray-500">
                                    <!-- Aquí puedes agregar botones de acción, como Editar o Eliminar -->
                                    <!-- Botón de Editar -->
                                    <button class="bg-amber-400 rounded text-slate-100 hover:text-white p-2 sendEdit"
                                        data-name="{{ $row->Id }}"
                                        title="Editar">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                    <!-- Botón de Eliminar -->
                                    <button class="bg-red-600 rounded text-slate-100 hover:text-white p-2 sendDelete"
                                        data-name="{{ $row->Id }}"
                                        title="Eliminar">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if ($showPagination)
            <div class="mt-4">
                {{ $data->links() }}
            </div>
        @endif
    @else
        <p class="text-center">No hay datos para mostrar.</p>
    @endif
</div>

@push('scripts')
    @vite(['resources/js/table-client.js'])
@endpush
