<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Note;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all();
        $tags = Tag::all();
        $users = User::all();
        
        //création des notes (appelée 45 fois ici)
        Note::factory(45)
        // implémentation et assignation aléatoire des categories
        ->sequence(fn () => [
            'category_id' => $categories->random(),
        ])
        // méthode magique, détecte la relation pour attribuer des commentaires aux notes
        // fonction fléchée pour affecter un user random à chaque commentaire crée
        ->hasComments(5, fn () => ['user_id' => $users->random()])
        ->create()
        // tags() est la fonction de belongs to many dans Note.php
        // attach pour lier les tags sur les notes
        // assignation d'un nombre aléatoire (0 a 2) de tags aux notes
        ->each(fn ($note) => $note->tags()->attach($tags->random(rand(0, 2))));
    }
}
