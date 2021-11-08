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
            'username' => 'admin',
            'email' => 'admin@banksinarmas.com',
            'password' => bcrypt('admin'),
            'photo' => 'photo-profile.png',
            'roleID' => 1,
        ]);
        User::create([
            'name' => 'Head Division',
            'username' => 'head.division',
            'email' => 'headdivision@banksinarmas.com',
            'password' => bcrypt('simas123'),
            'photo' => 'photo-profile.png',
            'roleID' => 2,
        ]);
        User::create([
            'name' => 'Head Department1',
            'username' => 'head.department1',
            'email' => 'headdepartment1@banksinarmas.com',
            'password' => bcrypt('simas123'),
            'photo' => 'photo-profile.png',
            'roleID' => 3,
        ]);
        User::create([
            'name' => 'Head Department2',
            'username' => 'head.department2',
            'email' => 'headdepartment2@banksinarmas.com',
            'password' => bcrypt('simas123'),
            'photo' => 'photo-profile.png',
            'roleID' => 4,
        ]);
        User::create([
            'name' => 'Head Department3',
            'username' => 'head.department3',
            'email' => 'headdepartment3@banksinarmas.com',
            'password' => bcrypt('simas123'),
            'photo' => 'photo-profile.png',
            'roleID' => 5,
        ]);
        User::create([
            'name' => 'Head Department4',
            'username' => 'head.department4',
            'email' => 'headdepartment4@banksinarmas.com',
            'password' => bcrypt('simas123'),
            'photo' => 'photo-profile.png',
            'roleID' => 6,
        ]);
        User::create([
            'name' => 'Member Department1',
            'username' => 'member.department1',
            'email' => 'memberdepartment1@banksinarmas.com',
            'password' => bcrypt('simas123'),
            'photo' => 'photo-profile.png',
            'roleID' => 7,
        ]);
        User::create([
            'name' => 'Member Department2',
            'username' => 'member.department2',
            'email' => 'memberdepartment2@banksinarmas.com',
            'password' => bcrypt('simas123'),
            'photo' => 'photo-profile.png',
            'roleID' => 8,
        ]);
        User::create([
            'name' => 'Member Department3',
            'username' => 'member.department3',
            'email' => 'memberdepartment3@banksinarmas.com',
            'password' => bcrypt('simas123'),
            'photo' => 'photo-profile.png',
            'roleID' => 9,
        ]);
        User::create([
            'name' => 'Member Department4',
            'username' => 'member.department4',
            'email' => 'memberdepartment4@banksinarmas.com',
            'password' => bcrypt('simas123'),
            'photo' => 'photo-profile.png',
            'roleID' => 10,
        ]);
    }
}
