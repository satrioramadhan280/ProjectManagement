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
            'name' => 'HDiv',
        ]);
        Role::create([
            'name' => 'HDept1',
        ]);
        Role::create([
            'name' => 'HDept2',
        ]);
        Role::create([
            'name' => 'HDept3',
        ]);
        Role::create([
            'name' => 'HDept4',
        ]);
        Role::create([
            'name' => 'MDept1',
        ]);
        Role::create([
            'name' => 'MDept2',
        ]);
        Role::create([
            'name' => 'MDept3',
        ]);
        Role::create([
            'name' => 'MDept4',
        ]);
    }
}
