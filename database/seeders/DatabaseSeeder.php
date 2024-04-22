<?php

namespace Database\Seeders;

use App\Models\Note;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            // On crée categ et tags avant pour ensuite les assigner aux notes
            CategorySeeder::class,
            TagSeeder::class,
            NoteSeeder::class,
        ]);
    }
}
