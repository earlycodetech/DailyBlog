<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $cat_id = Category::inRandomOrder()->first()->id;
        $title = fake()->unique()->realText(30);
        $slug =  Str::slug($title);
        $image = fake()->image(public_path('uploads'), 640, 480, null,false);

        return [
            'category_id' => $cat_id,
            'title' => $title,
            'slug' => $slug,
            'abstract' => fake()->realText(100),
            'content' => fake()->realText(600),
            'cover_image' => "uploads/" .$image
        ];
    }
}
