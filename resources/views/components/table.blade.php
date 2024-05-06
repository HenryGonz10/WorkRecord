@props(['headers' => [], 'data' => []])

@if (!empty($data)) <!-- Verifica que hay datos -->
    <div class="overflow-x-auto">
        <table class="table-auto w-full text-left border-collapse">
            <thead>
                <tr>
                    @foreach ($headers as $header)
                        <th class="px-4 py-2 border-b uppercase text-blue-900">
                            {{ $header }}
                        </th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $row)
                    <tr>
                        @foreach ($headers as $header)
                            <td class="px-4 py-2 border-b text-gray-500">
                                {{ $row[$header] ?? '' }} <!-- Evitar error si la clave no existe -->
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@else
    <p class="text-center">No hay datos para mostrar.</p>
@endif
