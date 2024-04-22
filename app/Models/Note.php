<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Note extends Model
{
    use HasFactory;

    // regroupe les queries pour optimiser la consommation de données du site (voir foreachs sur note.blade.php)
    // eager loading
    protected $with = [
        'category',
        'tags'
    ];

    // change le slug en bas a gauche de l'écran quand on survole les boutons "lire la note"
    // Et aussi l'url quand on a cliqué dessus et qu'on arrive sur la page de la note
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    // relation note - categorie, une note appartient a une categorie
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    // relation many to many tags - notes
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }
}
