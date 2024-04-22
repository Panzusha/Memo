<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // transforme un tableau en collection pour créer les catégories
        $categories = collect(['RDV', 'Tâche ménagère', 'Activité', 'Travail', 'Club']);
        // itération foreach création des catégories, mass assignment
        $categories->each(fn ($category) => Category::create([
            'name' => $category,
            'slug' => Str::slug($category),
        ]));
    }
}
