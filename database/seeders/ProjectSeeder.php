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
            'startDate' => '2022-01-21',
            'endDate' => '2022-02-28',
        ]);

        Project::create([
            'title' => 'Project IT Customer Management',
            'deptID' => 3,
            'sysRequirements' => 'projectFiles/PR-002/fileSR2.pdf',
            'folder' => 'projectFiles/PR-002',
            'status_id' => 4,
            'startDate' => '2022-01-21',
            'endDate' => '2022-02-28',
        ]);

        Project::create([
            'title' => 'Project IT Customer Relationship ',
            'deptID' => 3,
            'sysRequirements' => 'projectFiles/PR-003/fileSR3.pdf',
            'folder' => 'projectFiles/PR-003',
            'status_id' => 7,
            'startDate' => '2022-01-21',
            'endDate' => '2022-02-01',
        ]);

        Project::create([
            'title' => 'Project IT Customer',
            'deptID' => 3,
            'sysRequirements' => 'projectFiles/PR-004/fileSR4.pdf',
            'folder' => 'projectFiles/PR-004',
            'status_id' => 7,
            'startDate' => '2022-01-21',
            'endDate' => '2022-02-03',
        ]);

        Project::create([
            'title' => 'Project IT Branch Delivery System',
            'deptID' => 4,
            'sysRequirements' => 'projectFiles/PR-005/fileSR5.pdf',
            'folder' => 'projectFiles/PR-005',
            'status_id' => 1,
            'startDate' => '2022-01-21',
            'endDate' => '2022-02-28',
        ]);

        Project::create([
            'title' => 'Project IT Branch System',
            'deptID' => 4,
            'sysRequirements' => 'projectFiles/PR-006/fileSR6.pdf',
            'folder' => 'projectFiles/PR-006',
            'status_id' => 6,
            'startDate' => '2022-01-21',
            'endDate' => '2022-02-28',
        ]);

        Project::create([
            'title' => 'Project IT Branch Delivery ',
            'deptID' => 4,
            'sysRequirements' => 'projectFiles/PR-007/fileSR7.pdf',
            'folder' => 'projectFiles/PR-002',
            'status_id' => 7,
            'startDate' => '2022-01-21',
            'endDate' => '2022-02-10',
        ]);

        Project::create([
            'title' => 'Project IT System',
            'deptID' => 4,
            'sysRequirements' => 'projectFiles/PR-008/fileSR8.pdf',
            'folder' => 'projectFiles/PR-008',
            'status_id' => 7,
            'startDate' => '2022-01-21',
            'endDate' => '2022-02-12',
        ]);

        Project::create([
            'title' => 'Project IT Micro and Retail Core Loan System',
            'deptID' => 5,
            'sysRequirements' => 'projectFiles/PR-009/fileSR9.pdf',
            'folder' => 'projectFiles/PR-009',
            'status_id' => 1,
            'startDate' => '2022-01-21',
            'endDate' => '2022-02-28',
        ]);

        Project::create([
            'title' => 'Project IT Micro System',
            'deptID' => 5,
            'sysRequirements' => 'projectFiles/PR-010/fileSR10.pdf',
            'folder' => 'projectFiles/PR-010',
            'status_id' => 4,
            'startDate' => '2022-01-21',
            'endDate' => '2022-02-28',
        ]);

        Project::create([
            'title' => 'Project IT Retail Core Loan System',
            'deptID' => 5,
            'sysRequirements' => 'projectFiles/PR-011/fileSR11.pdf',
            'folder' => 'projectFiles/PR-011',
            'status_id' => 6,
            'startDate' => '2022-01-21',
            'endDate' => '2022-02-28',
        ]);

        Project::create([
            'title' => 'Project IT Loan System',
            'deptID' => 5,
            'sysRequirements' => 'projectFiles/PR-012/fileSR12.pdf',
            'folder' => 'projectFiles/PR-012',
            'status_id' => 7,
            'startDate' => '2022-01-21',
            'endDate' => '2022-02-20',
        ]);

        Project::create([
            'title' => 'Project IT Internal Application',
            'deptID' => 6,
            'sysRequirements' => 'projectFiles/PR-013/fileSR13.pdf',
            'folder' => 'projectFiles/PR-013',
            'status_id' => 1,
            'startDate' => '2022-01-21',
            'endDate' => '2022-02-28',
        ]);
        
        Project::create([
            'title' => 'Project IT Internal',
            'deptID' => 6,
            'sysRequirements' => 'projectFiles/PR-014/fileSR14.pdf',
            'folder' => 'projectFiles/PR-014',
            'status_id' => 4,
            'startDate' => '2022-01-21',
            'endDate' => '2022-02-28',
        ]);

        Project::create([
            'title' => 'Project IT Application',
            'deptID' => 6,
            'sysRequirements' => 'projectFiles/PR-015/fileSR15.pdf',
            'folder' => 'projectFiles/PR-015',
            'status_id' => 6,
            'startDate' => '2022-01-21',
            'endDate' => '2022-02-28',
        ]);

        Project::create([
            'title' => 'Project IT',
            'deptID' => 6,
            'sysRequirements' => 'projectFiles/PR-016/fileSR16.pdf',
            'folder' => 'projectFiles/PR-016',
            'status_id' => 7,
            'startDate' => '2022-01-21',
            'endDate' => '2022-02-25',
        ]);

    }
}
