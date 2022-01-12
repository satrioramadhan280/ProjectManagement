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
            'title' => 'Project IT Customer Relationship Management',
            'deptID' => 3,
            'sysRequirements' => 'projectFiles/PR-001/fileSR1.pdf',
            'folder' => 'projectFiles/PR-001',
            'status_id' => 1,
            'startDate' => '2021-12-12',
            'endDate' => '2021-12-17',
        ]);
        Project::create([
            'title' => 'Project IT Branch Delivery System',
            'deptID' => 4,
            'sysRequirements' => 'projectFiles/PR-002/fileSR2.pdf',
            'folder' => 'projectFiles/PR-002',
            'status_id' => 1,
            'startDate' => '2021-12-12',
            'endDate' => '2021-12-17',
        ]);
        Project::create([
            'title' => 'Project IT Micro and Retail Core Loan System',
            'deptID' => 5,
            'sysRequirements' => 'projectFiles/PR-002/fileSR2.pdf',
            'folder' => 'projectFiles/PR-003',
            'status_id' => 1,
            'startDate' => '2021-12-12',
            'endDate' => '2021-12-17',
        ]);
        Project::create([
            'title' => 'Project IT Internal Application',
            'deptID' => 6,
            'sysRequirements' => 'projectFiles/PR-002/fileSR2.pdf',
            'folder' => 'projectFiles/PR-004',
            'status_id' => 1,
            'startDate' => '2021-12-12',
            'endDate' => '2021-12-17',
        ]);
    }
}
