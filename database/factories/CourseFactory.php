<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $faker = Faker::create();

        $categoryIds = Category::pluck('id')->toArray();

        return [
            'category_id' => $faker->randomElement($categoryIds),
            'title' => $faker->unique()->word . ' Course',
            'price' => $faker->numberBetween(60, 1000),
            'duration' => $faker->numberBetween(1, 10),
            'quota' => $faker->numberBetween(1, 15),
            'description' => $faker->paragraph,
            'status' => $faker->randomElement(['Active', 'Inactive']),
            'image_poster' => $faker->imageUrl(640, 480, 'sports', true, 'poster'),
            'image_banner' => $faker->imageUrl(1280, 720, 'sports', true, 'banner'),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
