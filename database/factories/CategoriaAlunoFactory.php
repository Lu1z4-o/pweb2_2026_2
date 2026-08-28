<?php

namespace Database\Factories;

use App\Models\CategoriaAluno;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<CategoriaAluno>
 */
class CategoriaAlunoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome'=> fake()->unique()->randomElement([
                'Fundamental',
                'Médio',
                'Graduação',
                'Pós-graduação']),
            'nivel'=> fake()->numberBetween(1,4),
        ];
    }
}
