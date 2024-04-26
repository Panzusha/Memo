{{-- fonction exists dans models/Post.php pour changer le titre selon ce qu'on fait --}}
<x-default-layout :title="$note->exists() ? 'Modifier une note' : 'Créer une note'">
    <form action="{{ $note->exists() ? route('admin.notes.update', ['note' => $note]) : route('admin.notes.store') }}" method="POST">
        @csrf
        {{-- @method indique a Laravel que l'on veut modifier la method de la balise form car de base seules POST ET
        GET sont possibles dans un formulaire. PATCH applique des modif partielles a une ressource --}}
        @if ($note->exists())
        @method('PATCH')
        @endif
        <div class="flex flex-col items-center justify-center space-y-4">
            <div class="w-11/12 sm:w-10/12 md:w-9/12 lg:w-8/12 xl:w-6/12 2xl:w-5/12 pb-4">
                <h1 class="text-base font-semibold leading-7 text-gray-900">
                    {{ $note->exists() ? 'Modifier une note' : 'Créer une note' }}</h1>
                <div class="mt-10 space-y-4">
                    {{-- utilisation des composants selon le type de champ --}}
                    {{-- le name correspond au nom de colonne dans la BDD --}}
                    {{-- value prise en compte si modif, pas si création --}}
                    <x-input name="title" label="Titre" :value="$note->title"/>
                    {{-- slug est une string qui est URL friendly (extrait titre dans ce cas précis) --}}
                    <x-input name="slug" label="Titre url" :value="$note->title" help="Laisser vide pour automatisation" />
                    {{-- utilisation du composant textarea --}}
                    <x-textarea name="content" label="Contenu de la note">{{ $note->content }}</x-textarea>
                    {{-- ":" indique une expression php , ici :list nous permet d'itérer dans la BDD (fonction index de AdminController.php) --}}
                    <x-select name="category_id" label="Catégorie" :value="$note->category_id" :list="$categories" />
                    {{-- même commentaire que ci dessus mais pour les tags --}}
                    <x-select name="tag_ids" label="Balise" :value="$note->tags" :list="$tags" multiple />
                </div>
            </div>
        </div>
        {{-- bouton publier --}}
        <div class="flex items-center justify-center mb-6 mt-2 gap-x-6">
            {{-- texte du bouton changeant en fonction de modif ou création --}}
            <button type="submit" class="rounded-3xl bg-sky-500 px-4 py-3 text-sm font-semibold text-white shadow-sm hover:bg-teal-500">
                {{ $note->exists() ? 'Mettre à jour' : 'Publier' }}
            </button>
        </div>
    </form>
</x-default-layout>