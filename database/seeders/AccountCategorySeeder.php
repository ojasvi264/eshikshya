<?php

namespace Database\Seeders;

use App\Models\AccountCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AccountCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AccountCategory::create([
            'name' => 'Liabilities'
        ]);

        AccountCategory::create([
            'name' => 'Assets'
        ]);

        AccountCategory::create([
            'name' => 'Expenditure'
        ]);

        AccountCategory::create([
            'name' => 'Income'
        ]);
    }
}
