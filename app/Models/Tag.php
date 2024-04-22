<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    use HasFactory;

    // change le slug en bas a gauche de l'écran quand on survole les tags
    // Et aussi l'url quand on a cliqué dessus
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    // relation many to many tags - notes
    public function notes(): BelongsToMany
    {
        return $this->belongsToMany(Note::class);
    }
}
