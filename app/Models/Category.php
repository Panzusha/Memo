<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    // change le slug en bas a gauche de l'écran quand on survole les catégories
    // Et aussi l'url quand on a cliqué dessus
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    // relation categories - notes , une categorie a plusieurs notes
    public function notes(): HasMany
    {
        return $this->hasMany(Note::class);
    }
}
