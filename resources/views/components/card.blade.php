@props(['header' => '', 'body' => '', 'footer' => ''])

<div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl rounded-md bg-clip-border">
    <div class="m-3">
        {!! $header !!}
    </div>
    <div class="m-3">
        {!! $body !!}
    </div>
    <div class="m-3">
        {!! $footer !!}
    </div>
</div>
