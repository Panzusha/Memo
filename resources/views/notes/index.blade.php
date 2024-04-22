<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>
    <script src="https://kit.fontawesome.com/fcbdabc328.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>   
<body class="antialiased">
    <header class="w-full py-6 md:py-8 lg:py-10">
        <div class="container mx-auto px-8 flex items-center justify-between">
            <a href="{{ route('index') }}" id="maison">
                <i class="fa-solid fa-house fa-2x"></i>
            </a>
            <h1 class="sm:text-2xl md:text-2xl lg:text-4xl xl:text-6xl font-light tracking-wider text-white">MEMO</h1>
            <h1></h1>
        </div>
    </header>
    <nav>
        {{-- boutons --}}
        <div class="flex justify-center items-center rounded-md shadow-sm" role="group">
            <button type="button" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-transparent border border-gray-900 rounded-s-lg hover:bg-gray-900 hover:text-white focus:z-10 focus:ring-2 focus:ring-gray-500 focus:bg-gray-900 focus:text-white dark:border-white dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:bg-gray-700">
                <i class="fa-solid fa-pen-to-square w-3 h-3 me-2"></i>
                Inscription
            </button>
            <button type="button" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-transparent border-t border-b border-gray-900 hover:bg-gray-900 hover:text-white focus:z-10 focus:ring-2 focus:ring-gray-500 focus:bg-gray-900 focus:text-white dark:border-white dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:bg-gray-700">
                <i class="fa-solid fa-diagram-project w-3 h-3 me-2"></i>
                Connexion
            </button>
            <button type="button" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-transparent border border-gray-900 rounded-e-lg hover:bg-gray-900 hover:text-white focus:z-10 focus:ring-2 focus:ring-gray-500 focus:bg-gray-900 focus:text-white dark:border-white dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:bg-gray-700">
                <i class="fa-solid fa-user-tie w-3 h-3 me-2"></i>
                Admin
            </button>
        </div>
        {{-- fin boutons --}}
        {{-- début recherche --}}
        <div class="flex justify-center items-center my-6">
            <form action="{{ route('index') }}" class="pb-3 pr-2 flex items-center border-b border-b-slate-300 text-slate-300 focus-within:border-b-slate-900 focus-within:text-slate-900 transition">
                <input id="search" value="" class="px-2 w-full outline-none leading-none placeholder-slate-400" type="search" name="search" placeholder="Rechercher une note">
                <button>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                        <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" />
                    </svg>
                </button>
            </form>
        </div>
        {{-- fin recherche --}}
    </nav>
    <main class="ml-10 mt-10 md:mt-12 lg:mt-16">
        <div class=" flex flex-wrap justify-evenly">
            {{-- Début note --}}
            {{-- itération dans la table BDD notes pour toutes les afficher --}}
            @foreach ($notes as $note)
            <article class="w-1/4 mx-2 flex flex-col py-4 my-2 bg-gray-100 border-black border-2 rounded-2xl">
                <div class="flex flex-col mt-5 space-y-5 lg:w-7/12 lg:mt-0 lg:ml-12">
                    <h1 class="font-bold text-slate-900 text-3xl lg:text-5xl leading-tight">{{ $note->title }}</h1>
                    <a href="" class="underline font-bold text-slate-900 text-lg">Catégorie</a>
                    <p class="text-xl lg:text-2xl text-slate-600">
                        {{ $note->excerpt }}
                    </p>
                    <a href="" class="w-8/12 py-4 px-6 font-semibold bg-indigo-500 transition text-slate-50 rounded-full">
                        <i class="fa-solid fa-glasses w-3 h-3 me-6"></i>
                        Lire la note
                    </a>
                    <ul class="flex flex-wrap gap-2">
                        <li><a href="" class="px-3 py-1 bg-green-500 text-indigo-50 rounded-full text-sm">Tag 1</a></li>
                        <li><a href="" class="px-3 py-1 bg-green-500 text-indigo-50 rounded-full text-sm">Tag 2</a></li>
                    </ul>
                </div>
            </article>
            @endforeach
            {{-- Fin note --}}
            {{-- pagination --}}
            {{ $notes->links() }}
        </div>
    </main>
    {{-- début footer --}}
    <footer class="w-full h-18 flex flex-col justify-center items-center py-4 mb-0 mt-2">
        <p class="text-white"><i class="fa-solid fa-globe me-1"></i>Projet réalisé par Emmanuel Walther <i class="fa-regular fa-copyright"></i></p>
        <p class="text-white">Avril 2024</p>
        <p class="text-white">DWWM Alençon</p>
    </footer>
    {{-- fin footer --}}
</body>
</html>