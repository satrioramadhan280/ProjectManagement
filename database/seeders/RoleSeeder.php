<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'Admin',
            'display' => 'Admin'
        ]);
        Role::create([
            'name' => 'HeadDivision',
            'display' => 'Head Division of IT Internal Business Process Application'
        ]);
        Role::create([
            'name' => 'HeadDepartment1',
            'display' => 'Head of IT Customer Relationship Management'
        ]);
        Role::create([
            'name' => 'HeadDepartment2',
            'display' => 'Head of IT Branch Delivery System'
        ]);
        Role::create([
            'name' => 'HeadDepartment3',
            'display' => 'Head of IT Micro and Retail Core Loan System'
        ]);
        Role::create([
            'name' => 'HeadDepartment4',
            'display' => 'Head of IT Internal Application'
        ]);
        Role::create([
            'name' => 'MemberDepartment1',
            'display' => 'IT Customer Relationship Management Member'
        ]);
        Role::create([
            'name' => 'MemberDepartment2',
            'display' => 'IT Branch Delivery System Member'
        ]);
        Role::create([
            'name' => 'MemberDepartment3',
            'display' => 'IT Micro and Retail Core Loan System Member' 
        ]);
        Role::create([
            'name' => 'MemberDepartment4',
            'display' => 'IT Internal Application Member'
        ]);
    }
}
