<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title'=>'Ciencias',
            'description'=>'Caderno de anotações sobre Ciencias',
            'user_id'=>1,
            'user_name'=>'Jose',
            'arquived'=>0,
            'exclued'=>0,
            'locked'=>0,
        ];
    }
}
