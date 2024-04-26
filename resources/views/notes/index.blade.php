{{-- Contient le composant note, utilisé sur page acceuil et page note individuelle --}}
{{-- composant blade 'layout' contient head, header, boutons nav et footer --}}
<x-default-layout>
    {{-- début recherche --}}
    <div class="flex justify-center items-center my-6">
        <form action="{{ route('index') }}" class="pb-3 pr-2 flex items-center border-b border-b-slate-300 text-slate-300 focus-within:border-b-slate-900 focus-within:text-slate-900 transition">
            <input id="search" value="{{ request()->search }}" class="px-2 w-full outline-none leading-none placeholder-slate-400" type="search" name="search" placeholder="Rechercher une note">
            <button>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                    <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" />
                </svg>
            </button>
        </form>
    </div>
    {{-- fin recherche --}}
    <div class="flex flex-wrap justify-evenly">
        {{-- Début note --}}
        {{-- itération dans la table BDD notes pour toutes les afficher --}}
        @forelse ($notes as $note)
        {{-- booléen list activé(true) en rapport avec le @prop du template note.blade.php --}}
        <x-note :note="$note" list />
        @empty
        <p class="text-slate-400 text-center">Aucun résultat.</p>
        @endforelse
        {{-- Fin note --}}
    </div>
    <div class="flex flex-wrap justify-evenly">
    {{-- pagination --}}
    {{ $notes->links() }}
    </div>
</x-default-layout>