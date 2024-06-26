{{-- Template de page principale, head header boutons nav et footer --}}
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <link rel= "stylesheet" href= "https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css" >
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>   
<body class="antialiased">
    <header class="w-full py-6 md:py-8 lg:py-10">
        <div class="container mx-auto px-8 flex items-center justify-between">
            {{-- bouton maison retour page accueil --}}
            <a href="{{ route('index') }}" id="maison">
                <img class="w-6 h-6 sm:w-7 sm:h-7 md:w-8 md:h-8 lg:w-10 lg:h-10 xl:w-12 xl:h-12" src="https://img.icons8.com/ios-filled/50/home.png" alt="home"/>
            </a>
            <h1 class="sm:text-2xl md:text-2xl lg:text-4xl xl:text-6xl font-light tracking-wider text-white">MEMO</h1>
            <h1></h1>
        </div>
    </header>
    <nav>
        {{-- boutons (x data active alpinejs pour la modif du bouton deconnexion) --}}
        <div x-data class="flex justify-center items-center rounded-md shadow-sm" role="group">
            {{-- @guest @else  affichage dynamique des boutons nav selon le statut de l'utilisateur --}}
            @guest
            <a href="{{ route('register') }}">
                <button type="button" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-transparent border border-gray-900 rounded-lg hover:bg-gray-900 hover:text-white focus:z-10 focus:ring-2 focus:ring-gray-500 focus:bg-gray-900 focus:text-white dark:border-white dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:bg-gray-700">
                    <img class="me-2" width="20" height="20" src="https://img.icons8.com/ios/50/add-user-male.png" alt="add-user-male"/>
                    Inscription
                </button>
            </a>
            <a href="{{ route('login') }}">
                <button type="button" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-transparent border border-gray-900 rounded-lg hover:bg-gray-900 hover:text-white focus:z-10 focus:ring-2 focus:ring-gray-500 focus:bg-gray-900 focus:text-white dark:border-white dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:bg-gray-700">
                    <img class="me-2" width="20" height="20" src="https://img.icons8.com/ios/50/networking-manager.png" alt="networking-manager"/>
                    Connexion
                </button>
            </a>
            @else
                <a href="{{ route('home') }}">
                <button type="button" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-transparent border border-gray-900 rounded-lg hover:bg-gray-900 hover:text-white focus:z-10 focus:ring-2 focus:ring-gray-500 focus:bg-gray-900 focus:text-white dark:border-white dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:bg-gray-700">
                    <img class="me-2" width="20" height="20" src="https://img.icons8.com/ios/50/settings--v1.png" alt="settings--v1"/>
                    Compte
                </button>
            </a>
            {{-- @click.prevent event listener alpinejs pour modifier le comportement du lien --}}
            {{-- logout fait référence au x-ref du formulaire juste en dessous --}}
            <a href="{{ route('logout') }}" @click.prevent="$refs.logout.submit()">
                <button type="button" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-transparent border border-gray-900 rounded-lg hover:bg-gray-900 hover:text-white focus:z-10 focus:ring-2 focus:ring-gray-500 focus:bg-gray-900 focus:text-white dark:border-white dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:bg-gray-700">
                    <img class="me-2" width="20" height="20" src="https://img.icons8.com/ios/50/networking-manager.png" alt="networking-manager"/>
                    Déconnexion
                </button>
            </a>
            {{-- formulaire caché pour gérer la déco sans utiliser http get (protection csrf) --}}
            <form x-ref="logout" action="{{ route('logout') }}" method="POST" class="hidden">
                @csrf
            </form>
            @endguest
            {{-- affichage du bouton seulement pour l'admin --}}
            @auth
            @if (Auth::user()->isAdmin())
            <a href="{{ route('admin.notes.index') }}">
                <button type="button" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-transparent border border-gray-900 rounded-lg hover:bg-gray-900 hover:text-white focus:z-10 focus:ring-2 focus:ring-gray-500 focus:bg-gray-900 focus:text-white dark:border-white dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:bg-gray-700">
                    <img class="me-2" width="20" height="20" src="https://img.icons8.com/ios/50/admin-settings-male.png" alt="admin-settings-male"/>
                    Admin
                </button>
            </a>
            @endif
            @endauth
        </div>
        {{-- fin boutons --}}
    </nav>
    {{-- utilisation session flash pour afficher un message en fonction de with+mot clé
    par exemple : return redirect()->route('home')->withStatus('Inscription réussie !');
    a la fin du processus de validation d'inscription dans RegisterController.php --}}
    @if (session('status'))
        <div class="flex justify-center mt-10 rounded-md bg-green-50 p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-green-800">{{ session('status') }}</p>
                </div>
            </div>
        </div>
    @endif

    <main class="ml-5 mr-5 mt-10 md:mt-12 lg:mt-16">
        {{-- slot contient tout ce qui sera entre balise ouvrante et fermante du composant --}}
        {{ $slot }}
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