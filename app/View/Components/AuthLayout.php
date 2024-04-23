<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;

class AuthLayout extends AbstractLayout
{
    /**
     * Create a new component instance.
     */
    // constructor property promotion, déclarer une propriété directement dans les paramètres du constructeur
    // surcharge du constructeur de la classe parent pour s'adapter au formulaire inscription
    public function __construct(
        public string $title = '',
        // action du formulaire
        public string $action = '',
        // bouton soumettre du formulaire
        public string $submitMessage = 'Soumettre',
    )
    {
        parent::__construct($title);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('layouts.auth');
    }
}
