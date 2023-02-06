<?php

namespace Database\Seeders;

use App\Models\Eclass;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EclassTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $classes = [
            [
                'name' => 'Nursery',
                'description' => 'This is class nursery.',
            ],
            [
                'name' => 'L.K.G',
                'description' => 'This is class LKG.',
            ],

            [
                'name' => 'U.K.G',
                'description' => 'This is class UKG.',
            ],
            [
                'name' => 'Class 1',
                'description' => 'This is class 1.',
            ],
            [
                'name' => 'Class 2',
                'description' => 'This is class 2.',
            ],

            [
                'name' => 'Class 3',
                'description' => 'This is class 3.',
            ],
            [
                'name' => 'Class 4',
                'description' => 'This is class 4.',
            ],
            [
                'name' => 'Class 5',
                'description' => 'This is class 5.',
            ],

            [
                'name' => 'Class 6',
                'description' => 'This is class 6.',
            ],
            [
                'name' => 'Class 7',
                'description' => 'This is class 7.',
            ],
            [
                'name' => 'Class 8',
                'description' => 'This is class 8.',
            ],
            [
                'name' => 'Class 9',
                'description' => 'This is class 9.',
            ],
            [
                'name' => 'Class 10',
                'description' => 'This is class 10.',
            ],
        ];

        foreach ($classes as $class) {
            Eclass::create($class);
        }
    }
}
