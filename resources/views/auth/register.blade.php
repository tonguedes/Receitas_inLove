<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-pink-100 via-purple-100 to-blue-100 px-4">
        <div class="w-full max-w-sm bg-white rounded-3xl shadow-xl border border-pink-100 p-8 space-y-6">
            <!-- Título -->
            <div class="text-center">
                <h2 class="text-2xl font-bold text-pink-600">👩‍🍳 Crie sua conta</h2>
                <p class="text-sm text-gray-500 mt-1">Registre-se para salvar e compartilhar receitas</p>
            </div>

            <!-- Formulário -->
            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                <!-- Nome -->
                <div>
                    <x-input-label for="name" :value="__('Nome')" class="text-pink-600 text-sm" />
                    <x-text-input id="name" class="mt-1 w-full rounded-lg border-pink-200 focus:ring-pink-300" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-1 text-sm text-pink-500" />
                </div>

                <!-- Email -->
                <div>
                    <x-input-label for="email" :value="__('Email')" class="text-pink-600 text-sm" />
                    <x-text-input id="email" class="mt-1 w-full rounded-lg border-pink-200 focus:ring-pink-300" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-1 text-sm text-pink-500" />
                </div>

                <!-- Senha -->
                <div>
                    <x-input-label for="password" :value="__('Senha')" class="text-pink-600 text-sm" />
                    <x-text-input id="password" class="mt-1 w-full rounded-lg border-pink-200 focus:ring-pink-300" type="password" name="password" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-1 text-sm text-pink-500" />
                </div>

                <!-- Confirmar senha -->
                <div>
                    <x-input-label for="password_confirmation" :value="__('Confirmar Senha')" class="text-pink-600 text-sm" />
                    <x-text-input id="password_confirmation" class="mt-1 w-full rounded-lg border-pink-200 focus:ring-pink-300" type="password" name="password_confirmation" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-sm text-pink-500" />
                </div>

                <!-- Ações -->
                <div class="flex items-center justify-between text-sm">
                    <a class="text-pink-600 hover:text-pink-700 transition" href="{{ route('login') }}">
                        Já tem conta?
                    </a>

                    <x-primary-button class="bg-pink-500 hover:bg-pink-600 focus:ring-pink-300">
                        Registrar
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
