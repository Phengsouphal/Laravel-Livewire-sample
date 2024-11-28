@props([

])
<div x-data="{ value: @entangle($attributes->wire('model')) }" x-init="
new Pikaday({ field: $refs.input, format:'MM/DD/YYYY' })
" x-on:change="value = $event.target.value" class=" flex rounded-md shadow-sm">
    <span
        class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">
        <svg class="  h-5 w-5 flex-shrink-0 text-gray-400" x-description="Heroicon name: mini/calendar"
            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
            <path fill-rule="evenodd"
                d="M5.75 2a.75.75 0 01.75.75V4h7V2.75a.75.75 0 011.5 0V4h.25A2.75 2.75 0 0118 6.75v8.5A2.75 2.75 0 0115.25 18H4.75A2.75 2.75 0 012 15.25v-8.5A2.75 2.75 0 014.75 4H5V2.75A.75.75 0 015.75 2zm-1 5.5c-.69 0-1.25.56-1.25 1.25v6.5c0 .69.56 1.25 1.25 1.25h10.5c.69 0 1.25-.56 1.25-1.25v-6.5c0-.69-.56-1.25-1.25-1.25H4.75z"
                clip-rule="evenodd"></path>
        </svg>
    </span>

    <input x-ref="input" {{ $attributes->whereDoesntStartWith('wire:model') }} x-bind:value="value"
    class="rounded-none rounded-r-md flex-1 form-input block w-full transition duration-150 ease-in-out sm:text-sm
    sm:leading-5" />
</div>

@push('styles')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/pikaday/css/pikaday.css">
@endpush

@push('scripts')
<script src="https://unpkg.com/moment"></script>
<script src="https://cdn.jsdelivr.net/npm/pikaday/pikaday.js"></script>

@endpush