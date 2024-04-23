<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Note;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\View\View;

class NoteController extends Controller
{
    // $request contient toutes les infos de la requête utilisateur
    // on factorise via notesView et méthode scope locale dans Note.php
    public function index(Request $request): View
    {
        // si j'ai un paramètre search, je cré un tableau avec une clé search pour que le IF dans
        // la méthode scopefilters Note.php soit activé, sinon tableau vide et aucun filtre ne sera appliqué
        return $this->notesView($request->search ? ['search' => $request->search] : []);

        // Ancienne version avant factorisation (voir methode notesView plus bas et Note.php)
        // $notes = Note::query();

        // // search est également le name du formulaire dans le template default.blade.php
        // if ($search = $request->search) {
        // // modulo(%) indique que la valeur recherchée peut se trouver partout
        // // recherche dans les colonnes BBD title et content
        // // Builder $query permet d'isoler les where en cas d'ajout d'autres + tard ( il les place dans une parenthèse au niveau des queries visible dans la BarryVDH debug bar )
        //     $notes->where(fn (Builder $query) => $query
        //         ->where('title', 'LIKE', '%' . $search . '%')
        //         ->orWhere('content', 'LIKE', '%' . $search . '%')
        //     );
        // }

        // // vue page accueil et pagination
        // return view('notes.index', [
        //     'notes' => $notes->latest()->paginate(9),
        // ]);
    }

    // filtrage des notes par catégories
    // on factorise via notesView et méthode scope locale dans Note.php
    public function notesByCategory(Category $category): View
    {
        return $this->notesView(['category' => $category]);

        // Ancienne version avant factorisation (voir methode notesView plus bas et Note.php)
        // return view('notes.index', [
        //     // 'notes' => $category->notes()->latest()->paginate(9),
        //     // On affiche seulement les notes dont la catégorie correspond a l'id de celle qu'on a cliqué
        //     'notes' => Note::where(
        //         'category_id', $category->id
        //     )->latest()->paginate(9),
        // ]);
    }

    // filtrage des notes par tag
    // on factorise via notesView et méthode scope locale dans Note.php
    public function notesByTag(Tag $tag): View
    {
        return $this->notesView(['tag' => $tag]);

        // Ancienne version avant factorisation (voir methode notesView plus bas et Note.php)
        // return view('notes.index', [
        //     // 'notes' => $tag->notes()->latest()->paginate(9),
        //     // On affiche seulement les notes dont la catégorie correspond a l'id de celle qu'on a cliqué
        //     // clause whereRelation pour comparer colonne<>valeur (opérateur 'égal' par défaut)
        //     'notes' => Note::whereRelation(
        //         'tags', 'tags.id', $tag->id
        //     )->latest()->paginate(9),
        // ]);
    }

    // vue factorisée de la page d'acceuil selon les filtres ou absence de filtre
    protected function notesView(array $filters): View
    {
        return view('notes.index', [
            'notes' => Note::filters($filters)->latest()->paginate(9),
        ]);
    }

    // vue page individuelle des notes
    public function show(Note $note): View
    {
        return view('notes.show', [
            'note' => $note,
        ]);
    }
}
