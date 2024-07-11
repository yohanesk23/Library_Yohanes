<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    // Define the model that this factory is for
    protected $model = Book::class;

    // Define the default state for the model
    public function definition()
    {
        return [
            // Generate a random sentence for the book title
            'title' => $this->faker->sentence,
            // Generate a random name for the book author
            'author' => $this->faker->name,
        ];
    }
}