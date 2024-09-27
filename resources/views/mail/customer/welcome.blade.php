<x-mail::message>
# {{ __('Welcome, :name', ['name' => $customer?->name]) }}

#### {{ __('You can open tickets using the email') }} <pre class="pre-code inline user-select-all">{{ $customer?->email }}</pre>.

<x-mail::button :url="$helpDeskUrl">
{{ __('Login on Help Desk') }}
</x-mail::button>

{{ __('Thanks, :team team', ['team' => config('app.name')]) }}
</x-mail::message>
