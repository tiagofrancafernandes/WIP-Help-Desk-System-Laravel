@props([
    'disabled' => false,
])

@php
$disabledClass = ($disabled ?? null) ? [
    'bg-gray-600 dark:bg-gray-600',
] : [
    'bg-gray-800 dark:bg-gray-200',
    'hover:bg-gray-700 dark:hover:bg-white',
    'focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300',
];
@endphp

<button
    {{ $attributes->merge([
        'type' => 'submit',
        'class' => 'inline-flex items-center px-4 py-2 ' . implode(' ', $disabledClass) . ' border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest  focus:outline-none focus:ring-0 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150'
    ]) }}>
    {{ $slot }}
</button>
