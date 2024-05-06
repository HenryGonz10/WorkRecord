@props(['items' => []])

<nav aria-label="breadcrumb">
    <ol class="flex space-x-2 items-center">
      @foreach ($items as $index => $item)
        <li class="flex items-center">
          <!-- Si hay un enlace, crear un enlace; de lo contrario, mostrar texto -->
          @if (isset($item['link']))
            <a href="{{ $item['link'] }}" class="text-blue-500 hover:text-blue-700">
              {{ $item['name'] }}
            </a>
          @else
            <span>{{ $item['name'] }}</span>
          @endif

          <!-- Añadir separador si no es el último elemento -->
          @if ($index < count($items) - 1)
            <span class="mx-2">/</span>
          @endif
        </li>
      @endforeach
    </ol>
  </nav>

