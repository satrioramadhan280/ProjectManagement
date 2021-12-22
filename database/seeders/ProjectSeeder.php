<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\ProjectUser;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Project::create([
            'title' => 'Project 1',
            'sysRequirements' => 'projectFiles/PR-001/fileSR1.pdf',
            'folder' => 'projectFiles/PR-001',
            'status' => 'Ongoing',
            'startDate' => '2021-12-12',
            'endDate' => '2021-12-17',
        ]);
        Project::create([
            'title' => 'Project 2',
            'sysRequirements' => 'projectFiles/PR-002/fileSR2.pdf',
            'folder' => 'projectFiles/PR-002',
            'status' => 'Ongoing',
            'startDate' => '2021-12-12',
            'endDate' => '2021-12-17',
        ]);
    }
}
