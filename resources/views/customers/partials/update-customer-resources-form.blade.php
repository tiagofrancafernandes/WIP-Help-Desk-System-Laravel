<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Customer Resources') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's customer information and email address.") }}
        </p>
    </header>

    <form method="POST" action="{{ route('customers.users.update', $customer?->id) }}" class="p-4 __mt-6 __space-y-6">
        @csrf
        @method('patch')

        <div class="w-full max-w-md p-3 bg-white border border-gray-200 rounded-lg shadow sm:p-4 dark:bg-gray-800 dark:border-gray-700">
            <div class="flex items-center justify-between mb-4">
                <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">Latest Customers</h5>
                <button
                    type="button" class="text-sm font-medium text-blue-600 hover:underline dark:text-blue-500"
                >
                    @lang('Select all')
                </button>
           </div>
           <div class="flow-root">
                <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                    <li class="p-3">
                        <div class="flex items-center">
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                    @lang('Can open tickets')
                                </p>
                            </div>
                            <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                <x-tiago-f2.tw-tab.inline-toggle
                                    name="can_open_tickets"
                                    :value="$customer?->can_open_tickets"
                                />
                            </div>
                        </div>
                    </li>
                </ul>
           </div>
        </div>

        <div class="flex items-center gap-4 mt-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'customer-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
