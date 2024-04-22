{{-- booléen list pour changer l'affichage de la note selon qu il soit sur la page index (list true) ou sur sa page propre (list false) --}}
{{-- @props permet de recup les propriétés et leurs valeurs sur des composants anonymes --}}
@props(['note', 'list' => false])

<article class="w-1/4 mx-2 flex flex-col py-4 my-2 bg-gray-100 border-black border-2 rounded-2xl">
    <div class="flex flex-col mt-5 space-y-5 lg:w-7/12 lg:mt-0 lg:ml-12">
        <h1 class="font-bold text-slate-900 text-3xl lg:text-5xl leading-tight">{{ $note->title }}</h1>
        {{-- affichage de la categorie si la note en possède une --}}
        @if ($note->category)
        {{-- lien qui passe par la route byCategory pour filtrer les notes selon la catégorie cliquée --}}
        <a href="{{ route('notes.byCategory', ['category' => $note->category]) }}" class="underline font-bold text-slate-900 text-lg">{{ $note->category->name }}</a>
        @endif
        <p class="text-xl lg:text-2xl text-slate-600">
            {{-- affichage changeant de la note selon si elle est listée (index) ou non (page note individuelle) --}}
            @if ($list)
            {{ $note->excerpt }}
            @else
            {!! nl2br(e($note->content)) !!}
            @endif
        </p>
        {{-- si note sur page index on affiche le lien "lire" sinon la date de création --}}
        @if ($list)
        {{-- route dynamique pour aller vers la note cliquée --}}
        <a href="{{ route('notes.show', ['note' => $note]) }}" class="w-8/12 py-4 px-6 font-semibold bg-indigo-500 transition text-slate-50 rounded-full">
            <i class="fa-solid fa-glasses w-3 h-3 me-6"></i>
            Lire la note
        </a>
        @else
        {{-- format pour modifier l'affichage de la date selon un standard européen --}}
        {{-- @datetime : directive qu'on a crée dans AppServiceProvider.php --}}
        <time class="text-xs text-slate-400" datetime="{{ $note->created_at }}">@datetime($note->created_at)</time>
        @endif
        {{-- affichage des tags si la collection n'est pas vide --}}
        @if ($note->tags->isNotEmpty())
        <ul class="flex flex-wrap gap-2">
            @foreach ($note->tags as $tag)
            <li><a href="{{ route('notes.byTag', ['tag' => $tag]) }}" class="px-3 py-1 bg-green-500 text-indigo-50 rounded-full text-sm">{{ $tag->name }}</a></li>
            @endforeach
        </ul>
        @endif
    </div>
</article>