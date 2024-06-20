<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form
        method="post" action="{{ route('customers.user.update_password', $customer) }}"
        class="mt-6 space-y-6"
        x-data="{
            password: '',
            password_confirmation: '',
            get newPassIsValid() {
                if (!this.password || this.password?.length < 8) {
                    return false;
                }

                console.log('this.password', this.password);
                return this.password === this.password_confirmation;
            }
        }"
    >
        @csrf
        @method('put')

        <div>
            <x-input-label for="update_password_password" :value="__('New Password')" />
            <x-text-input
            id="update_password_password"
            x-model="password"
            name="password"
            type="password"
            class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password_confirmation">
                {{ __('Confirm Password') }}
                <span
                    class="text-md text-red-500 dark:text-red-600"
                    x-show="password"
                >*</span>
            </x-input-label>
            <x-text-input
                id="update_password_password_confirmation"
                x-model="password_confirmation"
                name="password_confirmation"
                type="password"
                class="mt-1 block w-full"
                autocomplete="new-password"
                x-bind:required="password"
            />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button
                x-bind:class="{
                    'bg-gray-600 dark:bg-gray-600': !newPassIsValid,
                    'bg-gray-800 dark:bg-gray-200': newPassIsValid,
                    'hover:bg-gray-700 dark:hover:bg-white': newPassIsValid,
                    'focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300': newPassIsValid,
                }"
            >{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'password-updated')
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
