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
            'sysRequirements' => 'projectFiles/PR-1/fileSR1.pdf',
            'folder' => 'projectFiles/PR-1',
            'status_id' => 1,
            'startDate' => '2022-02-21',
            'endDate' => '2022-04-02',
            'progress' => 0,
        ]);

        Project::create([
            'title' => 'Project IT Customer Management',
            'deptID' => 3,
            'sysRequirements' => 'projectFiles/PR-2/fileSR2.pdf',
            'folder' => 'projectFiles/PR-2',
            'status_id' => 4,
            'startDate' => '2022-01-21',
            'endDate' => '2022-02-28',
            'progress' => 0,
        ]);

        Project::create([
            'title' => 'Project IT Customer Relationship ',
            'deptID' => 3,
            'sysRequirements' => 'projectFiles/PR-3/fileSR3.pdf',
            'folder' => 'projectFiles/PR-3',
            'status_id' => 7,
            'startDate' => '2022-02-21',
            'endDate' => '2022-04-02',
            'progress' => 0,
        ]);

        Project::create([
            'title' => 'Project IT Customer',
            'deptID' => 3,
            'sysRequirements' => 'projectFiles/PR-4/fileSR4.pdf',
            'folder' => 'projectFiles/PR-4',
            'status_id' => 7,
            'startDate' => '2022-01-21',
            'endDate' => '2022-02-03',
            'progress' => 0,
        ]);

        Project::create([
            'title' => 'Project IT Branch Delivery System',
            'deptID' => 4,
            'sysRequirements' => 'projectFiles/PR-5/fileSR5.pdf',
            'folder' => 'projectFiles/PR-5',
            'status_id' => 1,
            'startDate' => '2022-01-21',
            'endDate' => '2022-02-28',
            'progress' => 0,
        ]);

        Project::create([
            'title' => 'Project IT Branch System',
            'deptID' => 4,
            'sysRequirements' => 'projectFiles/PR-6/fileSR6.pdf',
            'folder' => 'projectFiles/PR-6',
            'status_id' => 6,
            'startDate' => '2022-01-21',
            'endDate' => '2022-02-28',
            'progress' => 0,
        ]);

        Project::create([
            'title' => 'Project IT Branch Delivery ',
            'deptID' => 4,
            'sysRequirements' => 'projectFiles/PR-7/fileSR7.pdf',
            'folder' => 'projectFiles/PR-7',
            'status_id' => 7,
            'startDate' => '2022-01-21',
            'endDate' => '2022-02-10','progress' => 0,
        ]);

        Project::create([
            'title' => 'Project IT System',
            'deptID' => 4,
            'sysRequirements' => 'projectFiles/PR-8/fileSR8.pdf',
            'folder' => 'projectFiles/PR-8',
            'status_id' => 7,
            'startDate' => '2022-01-21',
            'endDate' => '2022-02-12','progress' => 0,
        ]);

        Project::create([
            'title' => 'Project IT Micro and Retail Core Loan System',
            'deptID' => 5,
            'sysRequirements' => 'projectFiles/PR-9/fileSR9.pdf',
            'folder' => 'projectFiles/PR-9',
            'status_id' => 1,
            'startDate' => '2022-01-21',
            'endDate' => '2022-02-28','progress' => 0,
        ]);

        Project::create([
            'title' => 'Project IT Micro System',
            'deptID' => 5,
            'sysRequirements' => 'projectFiles/PR-10/fileSR10.pdf',
            'folder' => 'projectFiles/PR-10',
            'status_id' => 4,
            'startDate' => '2022-01-21',
            'endDate' => '2022-02-28','progress' => 0,
        ]);

        Project::create([
            'title' => 'Project IT Retail Core Loan System',
            'deptID' => 5,
            'sysRequirements' => 'projectFiles/PR-11/fileSR11.pdf',
            'folder' => 'projectFiles/PR-11',
            'status_id' => 6,
            'startDate' => '2022-01-21',
            'endDate' => '2022-02-28','progress' => 0,
        ]);

        Project::create([
            'title' => 'Project IT Loan System',
            'deptID' => 5,
            'sysRequirements' => 'projectFiles/PR-12/fileSR12.pdf',
            'folder' => 'projectFiles/PR-12',
            'status_id' => 7,
            'startDate' => '2022-01-21',
            'endDate' => '2022-02-20','progress' => 0,
        ]);

        Project::create([
            'title' => 'Project IT Internal Application',
            'deptID' => 6,
            'sysRequirements' => 'projectFiles/PR-13/fileSR13.pdf',
            'folder' => 'projectFiles/PR-13',
            'status_id' => 1,
            'startDate' => '2022-01-21',
            'endDate' => '2022-02-28','progress' => 0,
        ]);
        
        Project::create([
            'title' => 'Project IT Internal',
            'deptID' => 6,
            'sysRequirements' => 'projectFiles/PR-14/fileSR14.pdf',
            'folder' => 'projectFiles/PR-14',
            'status_id' => 4,
            'startDate' => '2022-01-21',
            'endDate' => '2022-02-28','progress' => 0,
        ]);

        Project::create([
            'title' => 'Project IT Application',
            'deptID' => 6,
            'sysRequirements' => 'projectFiles/PR-15/fileSR15.pdf',
            'folder' => 'projectFiles/PR-15',
            'status_id' => 6,
            'startDate' => '2022-01-21',
            'endDate' => '2022-02-28','progress' => 0,
        ]);

        Project::create([
            'title' => 'Project IT',
            'deptID' => 6,
            'sysRequirements' => 'projectFiles/PR-16/fileSR16.pdf',
            'folder' => 'projectFiles/PR-16',
            'status_id' => 7,
            'startDate' => '2022-01-21',
            'endDate' => '2022-02-25','progress' => 0,
        ]);

    }
}
