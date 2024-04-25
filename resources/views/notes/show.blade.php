{{-- Page note individuelle, utilise composants default et note --}}
<x-default-layout :title="$note->title">
    <div class=" flex flex-col items-center space-y-10">
        {{-- Début note --}}
        <x-note :note="$note"/>
        {{-- Fin note --}}
        {{-- champ pour ajouter un commentaire n'apparait que si authentifié --}}
        @auth
        {{-- ['note' => $note] correspond au paramètre variable dans la route définie dans web.php --}}
        <form action="{{ route('notes.comment', ['note' => $note]) }}" method="POST"> 
            @csrf
            <div class="flex h-12">
                <input class="w-full bg-slate-50 rounded-lg px-5 text-slate-900 focus:outline focus:outline-2 
                focus:outline-indigo-500" type="text" name="comment" placeholder="Commentez" 
                autocomplete="off">
                <button class="ml-2 w-12 flex justify-center items-center shrink-0 bg-teal-400 rounded-full text-indigo-50">
                    <img width="30" height="30" src="https://img.icons8.com/ios/50/pen.png" alt="pen"/>
                </button>
            </div>
            @error('comment')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </form>
        @endauth
        {{-- affichage des commentaires existants --}}
        <div class="space-y-8">
            {{-- itération dans la table des commentaires attaché à la note qu'on est entrain de lire --}}
            @foreach ($note->comments as $comment)
            <div class="flex bg-gray-100 p-6 rounded-lg">
                {{-- relation comment-user dans Models/Comment.php --}}
                <div class="ml-4 flex flex-col">
                    <div class="flex flex-col sm:flex-row sm:items-center">
                        {{-- nom de l'utilisateur qui a posté le commentaire --}}
                        <h2 class="font-bold text-slate-900 text-2xl">{{ $comment->user->name }}</h2>
                        {{-- date de création --}}
                        <time class="mt-2 sm:mt-0 sm:ml-4 text-xs text-slate-400" datetime="{{ $comment->created_at }}">@datetime($comment->created_at)</time>
                    </div>
                    {{-- contenu du commentaire --}}
                    <p class="mt-4 text-slate-800 sm:leading-loose">{{ $comment->content }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</x-default-layout>