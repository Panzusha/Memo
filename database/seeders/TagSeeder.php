<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use illuminate\Support\Str;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // transforme un tableau en collection pour créer les tags
        $tags = collect(['Mars', 'Jupiter', 'Saturne', 'Venus', 'Mercure', 'Neptune', 'Uranus']);
        // itération foreach création des tags, mass assignment
        $tags->each(fn ($tag) => Tag::create([
            'name' => $tag,
            'slug' => Str::slug($tag),
        ]));
    }
}
