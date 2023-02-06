<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'category_name' => 'Normal',
            ],
            [
                'category_name' => 'Orphan',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
