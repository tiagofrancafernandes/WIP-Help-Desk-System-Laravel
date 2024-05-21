@props([
    'defaultTab' => null,
    'extraData' => null,
    'classes' => null,
    'triggers',
    'items',
])

@php
$triggers = isset($triggers) && is_object($triggers) && $triggers?->attributes ? $triggers : null;
$items = isset($items) && is_object($items) && $items?->attributes ? $items : null;

$defaultTab = filter_var($defaultTab ?? null, FILTER_DEFAULT, FILTER_NULL_ON_FAILURE);
$extraData = filled($extraData) ? $extraData : [];
$extraData = is_array($extraData ?? null) || is_object($extraData ?? null) ? $extraData : [];
$classes = array_merge([
    'w-full' => true,
], is_array($classes ?? null) ? $classes : []);

if (!$triggers) {
    unset($triggers);
}

if (!$items) {
    unset($items);
}
@endphp

<div
    @class($classes)
    x-data="{
        defaultTab: {!! filled($defaultTab) ? "'{$defaultTab}'" : 'null' !!},
        extraData: @js($extraData),
        selectedTab: null,
        init() {
            this.selectTab(this.defaultTab);
            console.log(this.extraData);
        },
        setQuery(paramName, paramValue) {
            if (!window?.UrlHelpers || !window?.UrlHelpers?.setQuery) {
                return;
            }

            window?.UrlHelpers?.setQuery(paramName, paramValue);
        },
        selectTab(tab) {
            if (!tab || typeof tab !== 'string') {
                return;
            }

            this.selectedTab = tab;

            this.setQuery('activetab', tab);

            if (!this.$refs?.tabContainer) {
                return;
            }

            this.$refs?.tabContainer
                ?.querySelectorAll('[data-tab-id]')
                ?.forEach(element => {
                    let tabId = element.dataset.tabId || null;
                    element.style.display = 'none';

                    if (tabId !== tab) {
                        return;
                    }

                    element.style.display = 'block';
                });
        },
        tabIsActive(tab) {
            return tab && this.selectedTab === tab;
        },
        tabTriggerClasses(tab) {
            const mapClasses = (classes) => {
                let newClasses = {};
                classes = Array.isArray(classes) ? classes.join(' ').split(' ') : classes;
                classes = typeof classes === 'string' ? classes.split(' ') : classes;

                if (!Array.isArray(classes)) {
                    return newClasses;
                }

                classes.forEach(item => {
                    newClasses[item] = item;
                });

                return newClasses;
            };

            if (this.tabIsActive(tab)) {
                return mapClasses([
                    'text-blue-600',
                    'hover:text-blue-600',
                    'dark:text-blue-500',
                    'dark:hover:text-blue-500',
                    'border-blue-600',
                    'dark:border-blue-500',
                ]);
            }

            return mapClasses(
                'hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 dark:border-transparent text-gray-500 dark:text-gray-400 border-gray-100 dark:border-gray-700'
            );
        },
    }"
>
    <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
        <ul x-ref="tabSelectorContainer" class="flex flex-wrap -mb-px text-sm font-medium text-center" role="tablist">
            <!-- triggers -->
            {{ $triggers }}
            <!-- END triggers -->
        </ul>
    </div>
    <div x-ref="tabContainer">
        <!-- items -->
        {{ $items }}
        <!-- END items -->
    </div>
</div>
