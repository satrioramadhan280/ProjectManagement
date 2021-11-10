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
            'firstName' => 'Admin',
            'lastName' => '',
            'username' => 'admin',
            'email' => 'admin@banksinarmas.com',
            'password' => bcrypt('admin'),
            'photo' => 'photo-profile.png',
            'roleID' => 1,
            'dateOfBirth' => '1990-01-01'
        ]);
        User::create([
            'firstName' => 'Head',
            'lastName' => 'Division',
            'username' => 'head.division',
            'email' => 'headdivision@banksinarmas.com',
            'password' => bcrypt('simas123'),
            'photo' => 'photo-profile.png',
            'roleID' => 2,
            'dateOfBirth' => '1990-01-01'
        ]);
        User::create([
            'firstName' => 'Head',
            'lastName' => 'Department1',
            'username' => 'head.department1',
            'email' => 'headdepartment1@banksinarmas.com',
            'password' => bcrypt('simas123'),
            'photo' => 'photo-profile.png',
            'roleID' => 3,
            'dateOfBirth' => '1990-01-01'
        ]);
        User::create([
            'firstName' => 'Head',
            'lastName' => ' Department2',
            'username' => 'head.department2',
            'email' => 'headdepartment2@banksinarmas.com',
            'password' => bcrypt('simas123'),
            'photo' => 'photo-profile.png',
            'roleID' => 4,
            'dateOfBirth' => '1990-01-01'
        ]);
        User::create([
            'firstName' => 'Head',
            'lastName' => ' Department3',
            'username' => 'head.department3',
            'email' => 'headdepartment3@banksinarmas.com',
            'password' => bcrypt('simas123'),
            'photo' => 'photo-profile.png',
            'roleID' => 5,
            'dateOfBirth' => '1990-01-01'
        ]);
        User::create([
            'firstName' => 'Head',
            'lastName' => 'Department4',
            'username' => 'head.department4',
            'email' => 'headdepartment4@banksinarmas.com',
            'password' => bcrypt('simas123'),
            'photo' => 'photo-profile.png',
            'roleID' => 6,
            'dateOfBirth' => '1990-01-01'
        ]);
        User::create([
            'firstName' => 'Member',
            'lastName' => 'Department1',
            'username' => 'member.department1',
            'email' => 'memberdepartment1@banksinarmas.com',
            'password' => bcrypt('simas123'),
            'photo' => 'photo-profile.png',
            'roleID' => 7,
            'dateOfBirth' => '1990-01-01'
        ]);
        User::create([
            'firstName' => 'Member',
            'lastName' => 'Department2',
            'username' => 'member.department2',
            'email' => 'memberdepartment2@banksinarmas.com',
            'password' => bcrypt('simas123'),
            'photo' => 'photo-profile.png',
            'roleID' => 8,
            'dateOfBirth' => '1990-01-01'
        ]);
        User::create([
            'firstName' => 'Member',
            'lastName' => 'Department3',
            'username' => 'member.department3',
            'email' => 'memberdepartment3@banksinarmas.com',
            'password' => bcrypt('simas123'),
            'photo' => 'photo-profile.png',
            'roleID' => 9,
            'dateOfBirth' => '1990-01-01'
        ]);
        User::create([
            'firstName' => 'Member',
            'lastName' => 'Department4',
            'username' => 'member.department4',
            'email' => 'memberdepartment4@banksinarmas.com',
            'password' => bcrypt('simas123'),
            'photo' => 'photo-profile.png',
            'roleID' => 10,
            'dateOfBirth' => '1990-01-01'
        ]);
    }
}
