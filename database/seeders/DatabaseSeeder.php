<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserTableSeeder::class,
            RoleSeeder::class,
            DepartmentSeeder::class,
            DesignationSeeder::class,
            StaffSeeder::class,
            LeaveTypeSeeder::class,
            EclassTableSeeder::class,
            SectionTableSeeder::class,
            CategoryTableSeeder::class,
            SessionSeeder::class,
            SchoolSettingSeeder::class,
            AccountCategorySeeder::class,
        ]);
    }
}
