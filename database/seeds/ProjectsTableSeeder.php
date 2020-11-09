<?php

use Illuminate\Database\Seeder;
use App\Project;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Project::create([
            'projectName' => 'Project A',
            'startDate' => '2020-01-01',
            'endDate' => '2020-01-31'
        ]);
        Project::create([
            'projectName' => 'Project B',
            'startDate' => '2020-01-15',
            'endDate' => '2020-01-31'
        ]);
        Project::create([
            'projectName' => 'Project C',
            'startDate' => '2020-02-01',
            'endDate' => '2020-01-29'
        ]);
        Project::create([
            'projectName' => 'Project D',
            'startDate' => '2020-03-01',
            'endDate' => '2020-03-15'
        ]);
    }
}
