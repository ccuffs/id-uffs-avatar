<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" x-data="{ loading: false }" x-on:submit="loading = true; $refs.btn.disabled = true;">
            @csrf

            <div>
                <x-jet-label for="email" value="{{ __('idUFFS') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="text" name="email" :value="old('email')" required autofocus placeholder="Ex. fulano.silva" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Senha') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <input id="remember_me" type="checkbox" class="form-checkbox" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Lembrar de mim') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="https://id.uffs.edu.br/id/XUI/#passwordReset">
                        {{ __('Esqueceu a senha?') }}
                    </a>
                @endif

                <button type="submit" x-ref="btn" class="ml-4 inline-flex items-center px-4 py-2 bg-green-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                    <span>{{ __('Entrar') }}</span>
                    <span x-show="loading">
                        <svg class="animate-spin text-white-200 h-5 w-5 ml-2" viewBox="0 0 38 38" xmlns="http://www.w3.org/2000/svg" stroke="#fff">
                            <g fill="none" fill-rule="evenodd">
                                <g transform="translate(1 1)" stroke-width="2">
                                    <circle stroke-opacity=".5" cx="18" cy="18" r="18"/>
                                    <path d="M36 18c0-9.94-8.06-18-18-18"></path>
                                </g>
                            </g>
                        </svg>
                    </span>
                </button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
