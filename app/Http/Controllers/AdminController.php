<?php

namespace App\Http\Controllers;

use App\Http\Requests\NoteRequest;
use App\Models\Category;
use App\Models\Note;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // vue page panneau de controle admin
    public function index()
    {
        return view('admin.notes.index', [
            // without pour désactiver le chargement des relations avec categories et tags
            'notes' => Note::without('category', 'tags')->latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return $this->showForm();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Note $note): View
    {
        return $this->showForm($note);
    }

    // note existante = modif, nouvelle note = création
    protected function showForm(Note $note = new Note): View
    {
        // correspond au chemin+nom du fichier template
        return view('admin.notes.form', [
            'note' => $note,
            // on recup les listes categ tag pour l'itération du menu select (formulaire création de post)
            'categories' => Category::orderBy('name')->get(),
            'tags' => Tag::orderBy('name')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    // demande sera rejetée si non validée par la fonction rules de la classe NoteRequest
    public function store(NoteRequest $request): RedirectResponse
    {
        return $this->save($request->validated());
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(NoteRequest $request, Note $note): RedirectResponse
    {
        return $this->save($request->validated(), $note);
    }

    // modif = $note, sinon valeur null (création)
    protected function save(array $data, Note $note = null): RedirectResponse
    {
        // création de l'extrait, tiré du contenu de l'article
        $data['excerpt'] = Str::limit($data['content'], 150);

        // s'il trouve une id correspondate il fait une MaJ du note, sinon il prend les data pour une création
        $note = Note::updateOrCreate(['id' => $note?->id], $data);

        // on utilise la relation tags définie dans note.php / ?? null si aucun tag n'est renseigné
        // sync synchronise les tags et les notes dans la table pivot
        // si un note a les tags A et B , et qu'on le met a jour avec C et D, sync enlevera les 2 anciens
        $note->tags()->sync($data['tag_ids'] ?? null);

        // redirection vers la note qui vient d être créee
        // si crée récemment 'publié' sinon 'mise a jour'
        return redirect()->route('notes.show', ['note' => $note])->withStatus(
            $note->wasRecentlyCreated ? 'Note publiée !' : 'Note mise à jour !'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    // suppression d'une note
    public function destroy(Note $note)
    {
        $note->delete();

        return redirect()->route('admin.notes.index');
    }
}
