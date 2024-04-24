{{-- Page compte utilisateur ( une fois authentifié) --}}
<x-default-layout title="Mon compte">
    <form action="{{ route('home') }}" method="POST">
        @csrf
        {{-- @method PATCH indique a Laravel que l'on veut modifier la method de la balise form car de base seules POST ET
        GET sont possibles dans un formulaire. PATCH applique des modif partielles a une ressource --}}
        @method('PATCH')
        <div class="flex flex-col items-center justify-center space-y-8">
            <div class="pb-10">
                <h1 class="text-base font-semibold leading-7 text-gray-900">Modification de votre mot de passe</h1>
                <div class="mt-10 space-y-8">
                    {{-- ré-utilisation du composant input (voir son template) --}}
                    <x-input type="password" name="current_password" label="Mot de passe actuel" />
                    <x-input type="password" name="password" label="Nouveau mot de passe" />
                    <x-input type="password" name="password_confirmation" label="Confirmation du nouveau mot de passe" />
                </div>
            </div>
        </div>
        {{-- bouton modifier --}}
        <div class="flex items-center justify-center mb-6 mt-2 gap-x-6">
            <button type="submit" class="rounded-3xl bg-sky-500 px-4 py-3 text-sm font-semibold text-white shadow-sm hover:bg-teal-500">Modifier</button>
        </div>
    </form>
</x-default-layout>