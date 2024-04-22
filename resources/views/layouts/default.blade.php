<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
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
    </nav>
    <main class="ml-10 mt-10 md:mt-12 lg:mt-16">
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