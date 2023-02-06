<?php

namespace Database\Seeders;

use App\Models\Designation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DesignationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $designations = [
            [
                'designation' => 'Administrator',
            ],
            [
                'designation' => 'Teacher',
            ],
            [
                'designation' => 'Staff',
            ],
            [
                'designation' => 'Accountant',
            ],
        ];

        foreach ($designations as $designation) {
            Designation::create($designation);
        }
    }
}
