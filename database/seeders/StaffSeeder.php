<?php

namespace Database\Seeders;

use App\Models\StaffDirectory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $staffs = [
            [
                'staff_id' => '11',
                'name' => 'Admin',
                'email' => 'admin@email.com',
                'password' => bcrypt('password'),
                'phone' => '9090909090',
                'gender' => 'male',
                'dob' => '1987-10-10',
                'marital_status' => 'single',
                'permanent_address' => 'KTM',
                'current_address' => 'KTM',
                'qualification' => 'masters',
                'work_experience' => '7 years',
                'emergency_phone' => '9898989898',
                'role_id' => 1,
                'designation_id' => 1,
                'department_id' => 1,
                'date_of_joining' => '2022-10-10',
            ],
            [
                'staff_id' => '12',
                'name' => 'Teacher first',
                'email' => 'teacher@email.com',
                'password' => bcrypt('password'),
                'phone' => '9090909090',
                'gender' => 'male',
                'dob' => '1987-10-10',
                'marital_status' => 'single',
                'permanent_address' => 'KTM',
                'current_address' => 'KTM',
                'qualification' => 'masters',
                'work_experience' => '7 years',
                'emergency_phone' => '9898989898',
                'role_id' => 2,
                'designation_id' => 2,
                'department_id' => 1,
                'date_of_joining' => '2022-10-10',
            ],
            [
                'staff_id' => '13',
                'name' => 'Librarian',
                'email' => 'librarian@email.com',
                'password' => bcrypt('password'),
                'phone' => '9090909090',
                'gender' => 'male',
                'dob' => '1987-10-10',
                'marital_status' => 'single',
                'permanent_address' => 'KTM',
                'current_address' => 'KTM',
                'qualification' => 'masters',
                'work_experience' => '7 years',
                'emergency_phone' => '9898989898',
                'role_id' => 3,
                'designation_id' => 3,
                'department_id' => 2,
                'date_of_joining' => '2022-10-10',
            ],
            [
                'staff_id' => '14',
                'name' => 'Accountant',
                'email' => 'accountant@email.com',
                'password' => bcrypt('password'),
                'phone' => '9090909090',
                'gender' => 'male',
                'dob' => '1987-10-10',
                'marital_status' => 'single',
                'permanent_address' => 'KTM',
                'current_address' => 'KTM',
                'qualification' => 'masters',
                'work_experience' => '7 years',
                'emergency_phone' => '9898989898',
                'role_id' => 4,
                'designation_id' => 1,
                'department_id' => 1,
                'date_of_joining' => '2022-10-10',
            ],
//            [
//                'staff_id' => '12',
//                'name' => 'Ram',
//                'email' => 'ram@email.com',
//                'password' => bcrypt('password'),
//                'phone' => '9090909090',
//                'gender' => 'male',
//                'dob' => '1987-10-10',
//                'marital_status' => 'single',
//                'permanent_address' => 'KTM',
//                'current_address' => 'KTM',
//                'qualification' => 'masters',
//                'work_experience' => '7 years',
//                'emergency_phone' => '9898989898',
//                'role_id' => 1,
//                'designation_id' => 1,
//                'department_id' => 1,
//                'date_of_joining' => '2022-10-10',
//            ]
            [
                'staff_id' => '15',
                'name' => 'Teacher Second',
                'email' => 'teachertest@email.com',
                'password' => bcrypt('password'),
                'phone' => '9124682351',
                'gender' => 'female',
                'dob' => '1988-01-10',
                'marital_status' => 'single',
                'permanent_address' => 'KTM',
                'current_address' => 'KTM',
                'qualification' => 'masters',
                'work_experience' => '4 years',
                'emergency_phone' => '9898989898',
                'role_id' => 2,
                'designation_id' => 2,
                'department_id' => 1,
                'date_of_joining' => '2022-10-10',
            ],
        ];

        foreach ($staffs as $staff) {
            StaffDirectory::create($staff);
        }
    }
}
