<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Note;
use App\Models\Tag;
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
        
        //création des notes
        Note::factory(45)
        // implémentation et assignation aléatoire des categories
        ->sequence(fn () => [
            'category_id' => $categories->random(),
        ])
        ->create()
        // implémentation et assignation aléatoire des tags
        ->each(fn ($note) => $note->tags()->attach($tags->random(rand(0, 2))));
    }
}
