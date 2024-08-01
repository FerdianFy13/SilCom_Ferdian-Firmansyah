<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'category_id' => 1,
                'name' => 'Basic Driving Course',
                'price' => 99,
                'duration' => 7,
                'description' => 'This course covers the basics of driving, including vehicle operation, traffic rules, and basic driving techniques.',
                'status' => 'Active',
                'image_poster' => 'https://example.com/images/basic-driving-course-poster.jpg',
                'image_banner' => 'https://example.com/images/basic-driving-course-banner.jpg',
            ],
            [
                'category_id' => 3,
                'name' => 'Advanced Driving Course',
                'price' => 143,
                'duration' => 11,
                'description' => 'This course is designed for experienced drivers and includes advanced driving techniques, defensive driving, and driving in adverse weather conditions.',
                'status' => 'Active',
                'image_poster' => 'https://example.com/images/advanced-driving-course-poster.jpg',
                'image_banner' => 'https://example.com/images/advanced-driving-course-banner.jpg',
            ],
        ];

        foreach ($data as $item) {
            Course::create([
                'category_id' => $item['category_id'],
                'title' => $item['name'],
                'price' => $item['price'],
                'duration' => $item['duration'],
                'quota' => 12,
                'description' => $item['description'],
                'status' => $item['status'],
                'image_poster' => $item['image_poster'],
                'image_banner' => $item['image_banner'],
            ]);
        }
    }
}
