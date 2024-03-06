<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <img src="https://www.telkomsel.com/sites/default/files/mainlogo-2022-rev.png" alt="Telkomsel"
                    class=" w-32">
            </a>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('otp.validation', $user->user_id) }}">
            @csrf

            <div>
                <x-label for="otp" :value="__('OTP CODE')" />
                <x-input id="otp" class="block mt-1 w-full" type="text" name="otp_code" required autofocus />
            </div>
            <div class="flex items-center justify-center mt-4">
                <x-button>
                    {{ __('Validate OTP CODE') }}
                </x-button>
            </div>
        </form>
        <form action="{{ route('resend-otp', $user->user_id) }}" method="post">
            @csrf
            <div class="flex items-center justify-center">
                <button type="submit" class="flex justify-center p-3 text-sm">
                    <p>Resend OTP</p>
                </button>
            </div>

        </form>
    </x-auth-card>
</x-guest-layout>
