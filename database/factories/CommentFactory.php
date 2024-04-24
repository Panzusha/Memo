<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // date du commentaire aléatoire entre ajd et il y a un an
        $created_at = fake()->dateTimeBetween('-1 year');

        return [
            // génération faker d'une phrase et date du commentaire
            'content' => fake()->sentence,
            'created_at' => $created_at,
            'updated_at' => $created_at,
        ];
    }
}
