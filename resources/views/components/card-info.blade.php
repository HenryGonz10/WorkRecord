@props(['titulo' => '', 'subtitulo' => '', 'icono' => '', 'texto' => ''])

<div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
    <div
        class="relative flex flex-col min-w-0 break-words bg-white shadow-xl rounded-md bg-clip-border">
        <div class="flex-auto">
            <div class="flex flex-row -mx-3">
                <div class="flex-none w-2/3 max-w-full px-3">
                    <div class="m-4">
                        <p class="mb-0 font-sans text-sm font-semibold leading-normal uppercase text-blue-950">
                            {!! $titulo !!}
                        </p>
                        <h5 class="mb-2 font-bold">{!! $texto !!}</h5>
                        <p class="mb-0">
                            {!! $subtitulo !!}
                        </p>
                    </div>
                </div>
                <div class="w-1/3 py-2">
                    <div class="text-right basis-1/3 mr-6 mt-5">
                        {!! $icono !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
