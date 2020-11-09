<?php

use Illuminate\Database\Seeder;
use App\Department;

class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Department::create([
            'name' => 'Department A',
            'location' => 'Dallas'
        ]);

        Department::create([
            'name' => 'Department B',
            'location' => 'New York'
        ]);

        Department::create([
            'name' => 'Department C',
            'location' => 'Chicago'
        ]);

        Department::create([
            'name' => 'Department D',
            'location' => 'San Fransisco'
        ]);
    }
}
