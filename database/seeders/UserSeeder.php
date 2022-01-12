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
            'dateOfBirth' => '1990-01-01'
        ]);
        User::create([
            'name' => 'Head Division',
            'username' => 'head.division',
            'email' => 'headdivision@banksinarmas.com',
            'password' => bcrypt('simas123'),
            'photo' => 'photo-profile.png',
            'roleID' => 2,
            'dateOfBirth' => '1990-01-01'
        ]);
        User::create([
            'name' => 'Head Department1',
            'username' => 'head.department1',
            'email' => 'headdepartment1@banksinarmas.com',
            'password' => bcrypt('simas123'),
            'photo' => 'photo-profile.png',
            'roleID' => 3,
            'dateOfBirth' => '1990-01-01'
        ]);
        User::create([
            'name' => 'Head Department2',
            'username' => 'head.department2',
            'email' => 'headdepartment2@banksinarmas.com',
            'password' => bcrypt('simas123'),
            'photo' => 'photo-profile.png',
            'roleID' => 4,
            'dateOfBirth' => '1990-01-01'
        ]);
        User::create([
            'name' => 'Head Department3',
            'username' => 'head.department3',
            'email' => 'headdepartment3@banksinarmas.com',
            'password' => bcrypt('simas123'),
            'photo' => 'photo-profile.png',
            'roleID' => 5,
            'dateOfBirth' => '1990-01-01'
        ]);
        User::create([
            'name' => 'Head Department4',
            'username' => 'head.department4',
            'email' => 'headdepartment4@banksinarmas.com',
            'password' => bcrypt('simas123'),
            'photo' => 'photo-profile.png',
            'roleID' => 6,
            'dateOfBirth' => '1990-01-01'
        ]);
        User::create([
            'name' => 'Member Department1',
            'username' => 'member.department1',
            'email' => 'memberdepartment1@banksinarmas.com',
            'password' => bcrypt('simas123'),
            'photo' => 'photo-profile.png',
            'roleID' => 7,
            'dateOfBirth' => '1990-01-01'
        ]);
        User::create([
            'name' => 'Member Department2',
            'username' => 'member.department2',
            'email' => 'memberdepartment2@banksinarmas.com',
            'password' => bcrypt('simas123'),
            'photo' => 'photo-profile.png',
            'roleID' => 8,
            'dateOfBirth' => '1990-01-01'
        ]);
        User::create([
            'name' => 'Member Department3',
            'username' => 'member.department3',
            'email' => 'memberdepartment3@banksinarmas.com',
            'password' => bcrypt('simas123'),
            'photo' => 'photo-profile.png',
            'roleID' => 9,
            'dateOfBirth' => '1990-01-01'
        ]);
        User::create([
            'name' => 'Member Department4',
            'username' => 'member.department4',
            'email' => 'memberdepartment4@banksinarmas.com',
            'password' => bcrypt('simas123'),
            'photo' => 'photo-profile.png',
            'roleID' => 10,
            'dateOfBirth' => '1990-01-01'
        ]);
        User::create([
            'name' => 'Derick Yudanegara',
            'username' => 'dyuda12',
            'email' => 'derickyudanegara@gmail.com',
            'password' => bcrypt('simas123'),
            'photo' => 'photo-profile.png',
            'roleID' => 8,
            'dateOfBirth' => '1990-01-01'
        ]);

        // Dummy #gelombang 1
        User::create([
            'name' => 'User1 Last',
            'username' => 'user1',
            'email' => 'user1@banksinarmas.com',
            'password' => bcrypt('simas123'),
            'photo' => 'photo-profile.png',
            'roleID' => 7,
            'dateOfBirth' => '1990-01-01'
        ]);
        User::create([
            'name' => 'User2 Last',
            'username' => 'user2',
            'email' => 'user2@banksinarmas.com',
            'password' => bcrypt('simas123'),
            'photo' => 'photo-profile.png',
            'roleID' => 8,
            'dateOfBirth' => '1990-01-01'
        ]);
        User::create([
            'name' => 'User3 Last',
            'username' => 'user3',
            'email' => 'user3@banksinarmas.com',
            'password' => bcrypt('simas123'),
            'photo' => 'photo-profile.png',
            'roleID' => 9,
            'dateOfBirth' => '1990-01-01'
        ]);
        User::create([
            'name' => 'User3 Last',
            'username' => 'user4',
            'email' => 'user4@banksinarmas.com',
            'password' => bcrypt('simas123'),
            'photo' => 'photo-profile.png',
            'roleID' => 10,
            'dateOfBirth' => '1990-01-01'
        ]);

        // Dummy #gelombang 2
        User::create([
            'name' => 'Billy',
            'username' => 'billy',
            'email' => 'billy@banksinarmas.com',
            'password' => bcrypt('simas123'),
            'photo' => 'photo-profile.png',
            'roleID' => 7,
            'dateOfBirth' => '1990-01-01'
        ]);
        User::create([
            'name' => 'Anton Joni Malaka Bu',
            'username' => 'anton',
            'email' => 'anton@banksinarmas.com',
            'password' => bcrypt('simas123'),
            'photo' => 'photo-profile.png',
            'roleID' => 8,
            'dateOfBirth' => '1990-01-01'
        ]);
        User::create([
            'name' => 'Jeremy',
            'username' => 'jeremy',
            'email' => 'jeremy@banksinarmas.com',
            'password' => bcrypt('simas123'),
            'photo' => 'photo-profile.png',
            'roleID' => 9,
            'dateOfBirth' => '1990-01-01'
        ]);
        User::create([
            'name' => 'Jessica',
            'username' => 'jessica',
            'email' => 'jessica@banksinarmas.com',
            'password' => bcrypt('simas123'),
            'photo' => 'photo-profile.png',
            'roleID' => 10,
            'dateOfBirth' => '1990-01-01'
        ]);
        
        // Dummy #gelombang 3
        User::create([
            'name' => 'Bonar',
            'username' => 'bonar',
            'email' => 'bonar@banksinarmas.com',
            'password' => bcrypt('simas123'),
            'photo' => 'photo-profile.png',
            'roleID' => 7,
            'dateOfBirth' => '1990-01-01'
        ]);
        User::create([
            'name' => 'Michael',
            'username' => 'michael',
            'email' => 'michael@banksinarmas.com',
            'password' => bcrypt('simas123'),
            'photo' => 'photo-profile.png',
            'roleID' => 8,
            'dateOfBirth' => '1990-01-01'
        ]);
        User::create([
            'name' => 'Sisca',
            'username' => 'sisca',
            'email' => 'sisca@banksinarmas.com',
            'password' => bcrypt('simas123'),
            'photo' => 'photo-profile.png',
            'roleID' => 9,
            'dateOfBirth' => '1990-01-01'
        ]);
        User::create([
            'name' => 'Dora',
            'username' => 'dora',
            'email' => 'dora@banksinarmas.com',
            'password' => bcrypt('simas123'),
            'photo' => 'photo-profile.png',
            'roleID' => 10,
            'dateOfBirth' => '1990-01-01'
        ]);

        // Dummy #gelombang 4
        User::create([
            'name' => 'Stanley',
            'username' => 'stanley',
            'email' => 'stanley@banksinarmas.com',
            'password' => bcrypt('simas123'),
            'photo' => 'photo-profile.png',
            'roleID' => 7,
            'dateOfBirth' => '1990-01-01'
        ]);
        User::create([
            'name' => 'Kikky',
            'username' => 'kikky',
            'email' => 'kikky@banksinarmas.com',
            'password' => bcrypt('simas123'),
            'photo' => 'photo-profile.png',
            'roleID' => 8,
            'dateOfBirth' => '1990-01-01'
        ]);
        User::create([
            'name' => 'Verrent',
            'username' => 'verrent',
            'email' => 'verrent@banksinarmas.com',
            'password' => bcrypt('simas123'),
            'photo' => 'photo-profile.png',
            'roleID' => 9,
            'dateOfBirth' => '1990-01-01'
        ]);
        User::create([
            'name' => 'Sinta',
            'username' => 'sinta',
            'email' => 'sinta@banksinarmas.com',
            'password' => bcrypt('simas123'),
            'photo' => 'photo-profile.png',
            'roleID' => 10,
            'dateOfBirth' => '1990-01-01'
        ]);

        // Dummy #gelombang 5
        User::create([
            'name' => 'Marlo',
            'username' => 'marlo',
            'email' => 'marlo@banksinarmas.com',
            'password' => bcrypt('simas123'),
            'photo' => 'photo-profile.png',
            'roleID' => 7,
            'dateOfBirth' => '1990-01-01'
        ]);
        User::create([
            'name' => 'Marco',
            'username' => 'marco',
            'email' => 'marco@banksinarmas.com',
            'password' => bcrypt('simas123'),
            'photo' => 'photo-profile.png',
            'roleID' => 8,
            'dateOfBirth' => '1990-01-01'
        ]);
        User::create([
            'name' => 'Amadea',
            'username' => 'amadea',
            'email' => 'amadea@banksinarmas.com',
            'password' => bcrypt('simas123'),
            'photo' => 'photo-profile.png',
            'roleID' => 9,
            'dateOfBirth' => '1990-01-01'
        ]);
        User::create([
            'name' => 'Fanny',
            'username' => 'fanny',
            'email' => 'fanny@banksinarmas.com',
            'password' => bcrypt('simas123'),
            'photo' => 'photo-profile.png',
            'roleID' => 10,
            'dateOfBirth' => '1990-01-01'
        ]);

        // Dummy #gelombang 6
        User::create([
            'name' => 'Gilang',
            'username' => 'gilang',
            'email' => 'gilang@banksinarmas.com',
            'password' => bcrypt('simas123'),
            'photo' => 'photo-profile.png',
            'roleID' => 7,
            'dateOfBirth' => '1990-01-01'
        ]);
        User::create([
            'name' => 'Leonardo',
            'username' => 'leonardo',
            'email' => 'leonardo@banksinarmas.com',
            'password' => bcrypt('simas123'),
            'photo' => 'photo-profile.png',
            'roleID' => 8,
            'dateOfBirth' => '1990-01-01'
        ]);
        User::create([
            'name' => 'Putri',
            'username' => 'putri',
            'email' => 'putri@banksinarmas.com',
            'password' => bcrypt('simas123'),
            'photo' => 'photo-profile.png',
            'roleID' => 9,
            'dateOfBirth' => '1990-01-01'
        ]);
        User::create([
            'name' => 'Margaretha',
            'username' => 'margaretha',
            'email' => 'margaretha@banksinarmas.com',
            'password' => bcrypt('simas123'),
            'photo' => 'photo-profile.png',
            'roleID' => 10,
            'dateOfBirth' => '1990-01-01'
        ]);

        // Dummy #gelombang 7
        User::create([
            'name' => 'Heung Min Son',
            'username' => 'hmson',
            'email' => 'hmson@banksinarmas.com',
            'password' => bcrypt('simas123'),
            'photo' => 'photo-profile.png',
            'roleID' => 7,
            'dateOfBirth' => '1990-01-01'
        ]);
        User::create([
            'name' => 'Kevin de Bruyne',
            'username' => 'kdb',
            'email' => 'kdb@banksinarmas.com',
            'password' => bcrypt('simas123'),
            'photo' => 'photo-profile.png',
            'roleID' => 8,
            'dateOfBirth' => '1990-01-01'
        ]);
        User::create([
            'name' => 'Cristiano Ronaldo',
            'username' => 'cr7',
            'email' => 'cr7@banksinarmas.com',
            'password' => bcrypt('simas123'),
            'photo' => 'photo-profile.png',
            'roleID' => 9,
            'dateOfBirth' => '1990-01-01'
        ]);
        User::create([
            'name' => 'Leo Messi',
            'username' => 'lm10',
            'email' => 'lm10@banksinarmas.com',
            'password' => bcrypt('simas123'),
            'photo' => 'photo-profile.png',
            'roleID' => 10,
            'dateOfBirth' => '1990-01-01'
        ]);

        // Dummy #gelombang 8
        User::create([
            'name' => 'Declan Rice',
            'username' => 'declanrice',
            'email' => 'declanrice@banksinarmas.com',
            'password' => bcrypt('simas123'),
            'photo' => 'photo-profile.png',
            'roleID' => 7,
            'dateOfBirth' => '1990-01-01'
        ]);
        User::create([
            'name' => 'Bruno Fernandes',
            'username' => 'brunofernandes',
            'email' => 'brunofernandes@banksinarmas.com',
            'password' => bcrypt('simas123'),
            'photo' => 'photo-profile.png',
            'roleID' => 8,
            'dateOfBirth' => '1990-01-01'
        ]);
        User::create([
            'name' => 'Alexander Lacazette',
            'username' => 'lacazette',
            'email' => 'lacazette@banksinarmas.com',
            'password' => bcrypt('simas123'),
            'photo' => 'photo-profile.png',
            'roleID' => 9,
            'dateOfBirth' => '1990-01-01'
        ]);
        User::create([
            'name' => 'Mo Salah',
            'username' => 'mosalah',
            'email' => 'mosalah@banksinarmas.com',
            'password' => bcrypt('simas123'),
            'photo' => 'photo-profile.png',
            'roleID' => 10,
            'dateOfBirth' => '1990-01-01'
        ]);
    }
}
