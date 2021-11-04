<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@banksinarmas.com',
            'password' => bcrypt('admin'),
            'roleID' => 1,
        ]);
        User::create([
            'name' => 'Head Division',
            'email' => 'headdivision@banksinarmas.com',
            'password' => bcrypt('simas123'),
            'roleID' => 2,
        ]);
        User::create([
            'name' => 'Head Department1',
            'email' => 'headdepartment1@banksinarmas.com',
            'password' => bcrypt('simas123'),
            'roleID' => 3,
        ]);
        User::create([
            'name' => 'Head Department2',
            'email' => 'headdepartment2@banksinarmas.com',
            'password' => bcrypt('simas123'),
            'roleID' => 4,
        ]);
        User::create([
            'name' => 'Head Department3',
            'email' => 'headdepartment3@banksinarmas.com',
            'password' => bcrypt('simas123'),
            'roleID' => 5,
        ]);
        User::create([
            'name' => 'Member Department3',
            'email' => 'headdepartment4@banksinarmas.com',
            'password' => bcrypt('simas123'),
            'roleID' => 6,
        ]);
        User::create([
            'name' => 'Member Department3',
            'email' => 'memberdepartment1@banksinarmas.com',
            'password' => bcrypt('simas123'),
            'roleID' => 7,
        ]);
        User::create([
            'name' => 'Member Department3',
            'email' => 'memberdepartment2@banksinarmas.com',
            'password' => bcrypt('simas123'),
            'roleID' => 8,
        ]);
        User::create([
            'name' => 'Member Department3',
            'email' => 'memberdepartment3@banksinarmas.com',
            'password' => bcrypt('simas123'),
            'roleID' => 9,
        ]);
        User::create([
            'name' => 'Member Department3',
            'email' => 'memberdepartment4@banksinarmas.com',
            'password' => bcrypt('simas123'),
            'roleID' => 10,
        ]);
    }
}
