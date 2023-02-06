<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $departments = [
            [
                'name' => 'Account',
            ],
            [
                'name' => 'Teaching',
            ],
            [
                'name' => 'Management',
            ],
            [
                'name' => 'Library',
            ],
        ];

        foreach ($departments as $department) {
            Department::create($department);
        }
    }
}
