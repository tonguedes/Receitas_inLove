<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-pink-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-6 bg-white p-8 rounded-2xl shadow-xl border border-green-100">
            <!-- Título -->
            <h2 class="text-center text-3xl font-extrabold text-green-600">Acesse sua conta</h2>

            <!-- Status da sessão -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Formulário de login -->
            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <!-- Email -->
                <div>
                    <x-input-label for="email" :value="__('Email')" class="text-pink-600" />
                    <x-text-input id="email" class="block mt-1 w-full border-pink-200 focus:ring-pink-300" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-pink-500" />
                </div>

                <!-- Senha -->
                <div>
                    <x-input-label for="password" :value="__('Senha')" class="text-pink-600" />
                    <x-text-input id="password" class="block mt-1 w-full border-pink-200 focus:ring-pink-300" type="password" name="password" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-pink-500" />
                </div>

                <!-- Lembrar -->
                <div class="flex items-center justify-between">
                    <label for="remember_me" class="inline-flex items-center text-sm text-gray-600">
                        <input id="remember_me" type="checkbox" class="rounded border-green-300 text-green-600 shadow-sm focus:ring-green-500" name="remember">
                        <span class="ml-2">Lembrar de mim</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a class="text-sm text-green-600 hover:text-green-800" href="{{ route('password.request') }}">
                            Esqueceu a senha?
                        </a>
                    @endif
                </div>

                <!-- Botão -->
                <div>
                    <x-primary-button class="w-full bg-green-500 hover:bg-green-600 focus:ring-green-300">
                        Entrar
                    </x-primary-button>
                </div>
            </form>

            <!-- Login com Google -->
            <div class="text-center">
                <a href="{{ route('google.redirect') }}"
                   class="block w-full text-center bg-red-400 hover:bg-red-500 text-white font-medium py-2 px-4 rounded-md transition">
                    Entrar com Google
                </a>
            </div>
        </div>
    </div>
</x-guest-layout>
