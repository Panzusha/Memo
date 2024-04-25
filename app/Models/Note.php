<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Note extends Model
{
    use HasFactory;

    // $fillable indique les champs qui doivent subir le mass assignment
    // $guarded indique ceux qui doivent être protégés du mass assignment
    protected $guarded = ['id', 'created_at', 'updated_at'];

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

    // factorisation des filtres de la page d'accueil avec une méthode scope locale
    public function scopeFilters(Builder $query, array $filters): void
    {
        // si il y a une clé search dans le tableau filters ( donc utilisation du champ de recherche)
        if (isset($filters['search'])) {
            $query->where(fn (Builder $query) => $query
                ->where('title', 'LIKE', '%' . $filters['search'] . '%')
                ->orWhere('content', 'LIKE', '%' . $filters['search'] . '%')
            );
        }

        // si on utilise le filtre par catégorie
        if (isset($filters['category'])) {
            $query->where(  // clause where pour comparer colonne<>valeur (opérateur 'égal' par défaut)
                // ?? est null coalescing operator, retourne le 1er opérant s'il existe et qu'il ne vaut pas null, 
                // sinon retourne le 2e
                'category_id', $filters['category']->id ?? $filters['category']
            );
        }

        // si on utilise le filtre par tag
        if (isset($filters['tag'])) {
            $query->whereRelation(
                // ?? est null coalescing operator, retourne le 1er opérant s'il existe et qu'il ne vaut pas null, 
                // sinon retourne le 2e
                'tags', 'tags.id', $filters['tag']->id ?? $filters['tag']
            );
        }
    }

    // pour déterminer dans le formulaire si on crée ou modfifie une note
    public function exists(): bool
    {
        return (bool) $this->id;
    }

    // relation note - categorie, une note appartient a une categorie
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    // relation many to many notes - tags
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    // relation note - commentaires
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class)->latest();
    }
}
