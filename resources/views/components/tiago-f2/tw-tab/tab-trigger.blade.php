@props([
    'tabId',
    'label',
    'classes' => [],
])

@php
$tabId = filter_var($tabId ?? null, FILTER_DEFAULT, FILTER_NULL_ON_FAILURE);
$label = filter_var($label ?? null, FILTER_DEFAULT, FILTER_NULL_ON_FAILURE);

if (!filled($label) || !is_string($label)) {
    unset($label);
}

if (!filled($tabId) || !is_string($tabId)) {
    unset($tabId);
}

$tabId = str($tabId)->camel()?->toString();

$extraData = filled($extraData ?? null) ? $extraData : [];
$extraData = is_array($extraData ?? null) || is_object($extraData ?? null) ? $extraData : [];
$classes = array_merge([
    // 'me-2' => true,
], is_array($classes ?? null) ? $classes : []);
@endphp

<li
    @class($classes)
    role="presentation"
>
    <button
        class="inline-block p-4 border-b-2 rounded-t-lg"
        x-on:click.capture="selectTab('{{ $tabId }}')"
        x-bind:class="tabTriggerClasses('{{ $tabId }}')"
        type="button"
        role="tab"
        data-extra="@js($extraData)"
        aria-controls="{{ $tabId }}"
        x-bind:aria-selected="tabIsActive('{{ $tabId }}')"
    >{{ $label ?? $slot }}</button>
</li>
