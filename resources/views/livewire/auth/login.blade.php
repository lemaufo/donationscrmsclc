<?php

use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component {
    #[Validate('required|string|email')]
    public string $email = '';

    #[Validate('required|string')]
    public string $password = '';

    public bool $remember = false;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->ensureIsNotRateLimited();

        if (! Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
        Session::regenerate();

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }

    /**
     * Ensure the authentication request is not rate limited.
     */
    protected function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout(request()));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => __('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the authentication rate limiting throttle key.
     */
    protected function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->email).'|'.request()->ip());
    }
}; ?>

<div class="flex flex-col gap-6">

    <div class="text-center">
        <h1 class="text-lg font-bold text-[#1e3a8a]">Inicio de sesión</h1>
        <p class="text-sm text-gray-500 mt-0.5">Impact Day 2026 · Cruz Roja Mexicana</p>
    </div>

    <x-auth-session-status class="text-center" :status="session('status')" />

    <form wire:submit="login" class="flex flex-col gap-4">

        <div>
            <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wide mb-1.5">
                Correo electrónico
            </label>
            <input
                wire:model="email"
                type="email"
                name="email"
                required
                autofocus
                autocomplete="email"
                class="w-full border-2 border-gray-100 rounded-xl px-4 py-3 text-gray-700 focus:outline-none focus:border-red-400 transition"
                placeholder="correo@ejemplo.com">
            @error('email')
                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <div class="flex items-center justify-between mb-1.5">
                <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wide">
                    Contraseña
                </label>
                @if(Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-xs text-red-600 hover:underline">
                    ¿Olvidaste tu contraseña?
                </a>
                @endif
            </div>
            <input
                wire:model="password"
                type="password"
                name="password"
                required
                autocomplete="current-password"
                class="w-full border-2 border-gray-100 rounded-xl px-4 py-3 text-gray-700 focus:outline-none focus:border-red-400 transition"
                placeholder="Tu contraseña">
            @error('password')
                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit"
            class="w-full bg-red-600 hover:bg-red-700 text-white font-bold rounded-2xl py-4 transition shadow-md mt-2">
            Iniciar sesión →
        </button>

    </form>

</div>