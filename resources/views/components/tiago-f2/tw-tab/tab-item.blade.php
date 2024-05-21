@props([
    'tabId',
    'content',
    'classes' => [],
])

@php
$tabId = filter_var($tabId ?? null, FILTER_DEFAULT, FILTER_NULL_ON_FAILURE);
$content = $content ?? null;

if (!filled($content) || !is_string($content)) {
    unset($content);
}

if (!filled($tabId) || !is_string($tabId)) {
    unset($tabId);
}

$tabId = str($tabId)->camel()?->toString();

$extraData = filled($extraData ?? null) ? $extraData : [];
$extraData = is_array($extraData ?? null) || is_object($extraData ?? null) ? $extraData : [];
$classes = array_merge([
    'p-4 rounded-lg bg-gray-50 dark:bg-gray-800' => true,
], is_array($classes ?? null) ? $classes : []);
@endphp

<div
    @class($classes)
    role="tabpanel"
    data-tab-id="{{ $tabId }}"
    data-extra="@js($extraData)"
    style="display: none;"
    aax-show="tabIsActive('{{ $tabId }}')"
>
{{-- <p class="text-sm text-gray-500 dark:text-gray-400">This is some placeholder content the <strong class="font-medium text-gray-800 dark:text-white">Profile tab's associated content</strong>. Clicking another tab will toggle the visibility of this one for the next. The tab JavaScript swaps classes to control the content visibility and styling.</p> --}}
{{ $content ?? $slot }}
</div>
