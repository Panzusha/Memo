{{-- booléen list pour changer l'affichage de la note selon qu il soit sur la page index (list true) ou sur sa page propre (list false) --}}
{{-- @props permet de recup les propriétés et leurs valeurs sur des composants anonymes --}}
@props(['note', 'list' => false])

<article class="w-11/12 sm:w-9/12 md:w-7/12 lg:w-6/12 xl:w-5/12 2xl:w-1/4 px-2 mx-2 flex flex-col py-4 my-2 bg-gray-100 border-black border-2 rounded-2xl">
    <div class="flex flex-col space-y-2 lg:ml-10">
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
        <a href="{{ route('notes.show', ['note' => $note]) }}" class="flex items-center w-40 h-12 py-2 px-4 font-semibold bg-indigo-500 transition text-slate-50 rounded-full">
            <img class="me-4" width="30" height="30" src="https://img.icons8.com/pastel-glyph/64/glasses.png" alt="glasses"/>
            <p>Lire la note</p>
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
            <li><a href="{{ route('notes.byTag', ['tag' => $tag]) }}" class="px-3 py-1 bg-green-500 text-indigo-50 rounded-full text-sm"
                >{{ $tag->name }}</a></li>
            @endforeach
        </ul>
        @endif
    </div>
</article>