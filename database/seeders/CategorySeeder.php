<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
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
                'name' => 'Beginner',
                'description' => 'Beginner',
            ],
            [
                'name' => 'Intermediate',
                'description' => 'Intermediate',
            ],
            [
                'name' => 'Advanced',
                'description' => 'Advanced',
            ],
            [
                'name' => 'Expert',
                'description' => 'Expert',
            ],
            [
                'name' => 'Professional',
                'description' => 'Professional',
            ]
        ];

        foreach ($data as $item) {
            Category::create([
                'name' => $item['name'],
                'description' => $item['description'],
            ]);
        }
    }
}
