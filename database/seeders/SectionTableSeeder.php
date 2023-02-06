<?php

namespace Database\Seeders;

use App\Models\Section;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SectionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sections = [
            [
                'name' => 'Section A',
                'eclasses_id' => '1',
            ],
            [
                'name' => 'Section B',
                'eclasses_id' => '1',
            ],
            [
                'name' => 'Section A',
                'eclasses_id' => '2',
            ],
            [
                'name' => 'Section B',
                'eclasses_id' => '2',
            ],
            [
                'name' => 'Section A',
                'eclasses_id' => '3',
            ],
            [
                'name' => 'Section A',
                'eclasses_id' => '4',
            ],
            [
                'name' => 'Section B',
                'eclasses_id' => '4',
            ],
            [
                'name' => 'Section A',
                'eclasses_id' => '5',
            ],
            [
                'name' => 'Section B',
                'eclasses_id' => '5',
            ],
            [
                'name' => 'Section A',
                'eclasses_id' => '6',
            ],
            [
                'name' => 'Section B',
                'eclasses_id' => '6',
            ],
            [
                'name' => 'Section A',
                'eclasses_id' => '7',
            ],
            [
                'name' => 'Section B',
                'eclasses_id' => '7',
            ],
            [
                'name' => 'Section A',
                'eclasses_id' => '8',
            ],
            [
                'name' => 'Section B',
                'eclasses_id' => '8',
            ],
            [
                'name' => 'Section A',
                'eclasses_id' => '9',
            ],
            [
                'name' => 'Section B',
                'eclasses_id' => '9',
            ],
            [
                'name' => 'Section C',
                'eclasses_id' => '9',
            ],
            [
                'name' => 'Section A',
                'eclasses_id' => '10',
            ],
            [
                'name' => 'Section B',
                'eclasses_id' => '10',
            ],
            [
                'name' => 'Section C',
                'eclasses_id' => '10',
            ],
            [
                'name' => 'Section A',
                'eclasses_id' => '11',
            ],
            [
                'name' => 'Section B',
                'eclasses_id' => '11',
            ],
            [
                'name' => 'Section C',
                'eclasses_id' => '11',
            ],
            [
                'name' => 'Section A',
                'eclasses_id' => '12',
            ],
            [
                'name' => 'Section B',
                'eclasses_id' => '12',
            ],
            [
                'name' => 'Section A',
                'eclasses_id' => '13',
            ],
        ];

        foreach ($sections as $section) {
            Section::create($section);
        }
    }
}
