@props([
    'name',
    'value',
    'yesLabel',
    'noLabel',
])

@php
$name = filter_var($name ?? null, FILTER_DEFAULT, FILTER_NULL_ON_FAILURE);
$yesLabel = filter_var($yesLabel ?? null, FILTER_DEFAULT, FILTER_NULL_ON_FAILURE) ?? __('Yes');
$noLabel = filter_var($noLabel ?? null, FILTER_DEFAULT, FILTER_NULL_ON_FAILURE) ?? __('No');

$value ??= null;

if (!filled($name)) {
    unset($name);
}
@endphp

<div
    x-data="{
        field_value: {{ $value ? 'true' : 'false' }},
    }"
>
    <div class="hidden">
        <input
            type="hidden"
            @if ($name ?? null)
            name="{{ $name }}"
            @endif
            x-model="field_value"
        >
    </div>
    <label
        class="inline-flex items-center me-5 cursor-pointer"
        data-type="inline-toggle-label"
    >
        <span class="me-3 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $noLabel }}</span>
        <input
            type="checkbox"
            class="sr-only peer"
            x-model="field_value"
            x-bind:checked="field_value"
            axx-on:change="(event) => {
                field_value = !field_value;
                {{-- event.preventDefault(); --}}
                {{-- event.target?.closest('form')?.submit(); --}}
            }"
        >
        <div class="relative w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-0 peer-focus:ring-red-300 dark:peer-focus:ring-red-800 dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-red-600"></div>
        <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $yesLabel }}</span>
    </label>
</div>
