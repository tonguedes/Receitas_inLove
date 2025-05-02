<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-pink-100 via-purple-100 to-blue-100 px-4">
        <div class="w-full max-w-sm bg-white rounded-3xl shadow-xl border border-pink-100 p-8 space-y-6">
            <!-- Título -->
            <div class="text-center">
                <h2 class="text-2xl font-bold text-pink-600">🌸 Bem-vindo de volta!</h2>
                <p class="text-sm text-gray-500 mt-1">Faça login para acessar suas receitas</p>
            </div>

            <!-- Status da sessão -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Formulário -->
            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <!-- Email -->
                <div>
                    <x-input-label for="email" :value="__('Email')" class="text-pink-600 text-sm" />
                    <x-text-input id="email" class="mt-1 w-full rounded-lg border-pink-200 focus:ring-pink-300" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-1 text-sm text-pink-500" />
                </div>

                <!-- Senha -->
                <div>
                    <x-input-label for="password" :value="__('Senha')" class="text-pink-600 text-sm" />
                    <x-text-input id="password" class="mt-1 w-full rounded-lg border-pink-200 focus:ring-pink-300" type="password" name="password" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-1 text-sm text-pink-500" />
                </div>

                <!-- Lembrar e Link -->
                <div class="flex items-center justify-between text-sm">
                    <label for="remember_me" class="inline-flex items-center text-gray-600">
                        <input id="remember_me" type="checkbox" class="rounded border-pink-300 text-pink-600 focus:ring-pink-400" name="remember">
                        <span class="ml-2">Lembrar de mim</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-pink-600 hover:text-pink-700 transition">Esqueceu?</a>
                    @endif
                </div>

                <!-- Botão de Login -->
                <x-primary-button class="w-full bg-pink-500 hover:bg-pink-600 focus:ring-pink-300">
                    Entrar
                </x-primary-button>
            </form>

            <!-- Divisor -->
            <div class="flex items-center my-4">
                <hr class="flex-grow border-pink-200">
                <span class="mx-2 text-sm text-gray-400">ou</span>
                <hr class="flex-grow border-pink-200">
            </div>

            <!-- Google Login -->
            <div class="text-center">
                <a href="{{ route('google.redirect') }}"
                   class="inline-block w-full bg-red-500 hover:bg-red-600 text-white text-sm font-medium py-2 px-4 rounded-lg transition">
                    Entrar com Google
                </a>
            </div>
        </div>
    </div>
</x-guest-layout>

