<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LoginController extends Controller
{
    public function showLoginForm(): View
    {
        return view('auth.login');
    }

    public function login(Request $request): RedirectResponse
    {
        // vérification préalable des 2 champs du formulaire de connexion
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        // si les données sont validées on envoie vers la page compte (home)
        // (bool) $request->remember fait référence à la case "rester connecté", valeur "on" si cochée (=true), false si pas cochée
        // si case cochée et connexion réussie, un cookie sera généré pour rester connecter sur la durée
        if (Auth::attempt($credentials, (bool) $request->remember)) {
            // regenerate protège des attaques par fixation de session
            $request->session()->regenerate();

            // dans RouteServiceProvider.php, HOME = '/home'
            // intended() permet de rediriger vers la page auquelle l'utilisateur tentait d'accéder 
            // avant de devoir passer par l'authentification
            return redirect()->intended(RouteServiceProvider::HOME);
        }

        // si non, msg d'erreur  session flash (mot clé with + ...)
        return back()->withErrors([
            'email' => 'Identifiants erronés.',
            // onlyinput, on renvoie la valeur du champ email mais on devra retaper le mdp
        ])->onlyInput('email');
    }

    public function logout(Request $request): RedirectResponse
    {
        // suppression des infos de session qui authentifient l'utilisateur
        Auth::logout();
        // suppression id session et contenu lié
        $request->session()->invalidate();
        // renouvellement token
        $request->session()->regenerateToken();
        // redirection page accueil
        return redirect('/');
    }
}
