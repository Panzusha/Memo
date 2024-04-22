<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Layout extends Component
{
    /**
     * Create a new component instance.
     */
    // constructor property promotion, déclarer une propriété directement dans les paramètres du constructeur
    public function __construct(public string $title = '')
    {
        // opérateur ternaire pour afficher le titre de la note cliquée dans l'onglet navigateur
        // on affiche le nom du projet + le nom de la note, si elle existe
        $this->title = config('app.name') . ($title ? " | $title" : '');
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('layouts.default');
    }
}
