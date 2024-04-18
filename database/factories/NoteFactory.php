<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Note>
 */
class NoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->unique()->sentence;
        // par défaut 3 paragraphes,
        $content = fake()->paragraphs(1, asText: true);
        // date aléatoire entre ajd et il y a un an
        $created_at = fake()->dateTimeBetween('-1 year');

        return [
            'title' => $title,
            'slug' => Str::slug($title), // slug converti en format adéquat pour l'URL
            'excerpt' => Str::limit($content, 50), // Str permet de manipuler des strings
            'content' => $content,
            'created_at' => $created_at,
            'updated_at' => $created_at,
        ];
    }
}
