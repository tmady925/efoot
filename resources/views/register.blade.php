<x-layouts.guest-custom>
    @section('page-title', 'Inscription')

    <x-authentication-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Erreurs de validation -->
        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Nom complet -->
            <div>
                <x-label for="name" :value="__('Nom complet')" />
                <x-input id="name" class="block mt-1 w-full" type="text"
                         name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <!-- Email -->
            <div class="mt-4">
                <x-label for="email" :value="__('Adresse email')" />
                <x-input id="email" class="block mt-1 w-full" type="email"
                         name="email" :value="old('email')" required autocomplete="username" />
            </div>

            <!-- Mot de passe -->
            <div class="mt-4">
                <x-label for="password" :value="__('Mot de passe')" />
                <x-input id="password" class="block mt-1 w-full" type="password"
                         name="password" required autocomplete="new-password" />
            </div>

            <!-- Confirmation -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirmer le mot de passe')" />
                <x-input id="password_confirmation" class="block mt-1 w-full"
                         type="password" name="password_confirmation" required />
            </div>

            <!-- Lien de connexion -->
            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900"
                   href="{{ route('login') }}">
                    {{ __('Déjà inscrit ?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('S\'inscrire') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-layouts.guest-custom>
