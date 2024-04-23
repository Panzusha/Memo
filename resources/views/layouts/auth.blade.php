<!DOCTYPE html>
<html lang="fr" class="h-full bg-gray-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <script src="https://kit.fontawesome.com/fcbdabc328.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>   
<body class="antialiased h-full">
    <header class="w-full py-6 md:py-8 lg:py-10">
        <div class="container mx-auto px-8 flex items-center justify-between">
            {{-- bouton maison retour page accueil --}}
            <a href="{{ route('index') }}" id="maison">
                <i class="fa-solid fa-house fa-2x"></i>
            </a>
            <h1 class="sm:text-2xl md:text-2xl lg:text-4xl xl:text-6xl font-light tracking-wider text-white">MEMO</h1>
            <h1></h1>
        </div>
    </header>
    {{-- formulaire inscription --}}
    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-[480px]">
        <div class="bg-white px-6 py-10 shadow sm:rounded-lg sm:px-12">
            <form action="{{ $action }}" method="POST" novalidate>
                {{-- @ csrf = protection cross site request forgery (utiliser les droits d'un utilisateur pour lui faire 
                faire des actions sur le site sans qu'il le sache). Un champ caché est ajouté qui vas générer un token --}}
                @csrf
                <div class="space-y-6">
                    {{-- slot contient tout ce qui sera entre balise ouvrante et fermante du composant --}}
                    {{ $slot }}
                    <div>
                        <button type="submit" class="flex w-full justify-center rounded-md bg-teal-500 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-sky-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">{{ $submitMessage }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    {{-- fin formulaire --}}
</body>
</html>