<x-mail::message>
# Hello {{ $user }}

Thanks For creating an account in {{ config('app.name') }}.

<x-mail::button :url="$url" color="success">
    Login to Account
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
