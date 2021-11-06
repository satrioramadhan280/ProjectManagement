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
        ]);
        Role::create([
            'name' => 'HeadDivision',
        ]);
        Role::create([
            'name' => 'HeadDepartment1',
        ]);
        Role::create([
            'name' => 'HeadDepartment2',
        ]);
        Role::create([
            'name' => 'HeadDepartment3',
        ]);
        Role::create([
            'name' => 'HeadDepartment4',
        ]);
        Role::create([
            'name' => 'MemberDepartment1',
        ]);
        Role::create([
            'name' => 'MemberDepartment2',
        ]);
        Role::create([
            'name' => 'MemberDepartment3',
        ]);
        Role::create([
            'name' => 'MemberDepartment4',
        ]);
    }
}
