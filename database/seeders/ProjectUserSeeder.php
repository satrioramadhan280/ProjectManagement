<?php

namespace Database\Seeders;

use App\Models\ProjectUser;
use Illuminate\Database\Seeder;

class ProjectUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProjectUser::create([
            'project_id' => 1,
            'user_id' => 7,
        ]);

        ProjectUser::create([
            'project_id' => 1,
            'user_id' => 12,
        ]);

        ProjectUser::create([
            'project_id' => 2,
            'user_id' => 16,
        ]);

        ProjectUser::create([
            'project_id' => 2,
            'user_id' => 20,
        ]);

        ProjectUser::create([
            'project_id' => 3,
            'user_id' => 24,
        ]);

        ProjectUser::create([
            'project_id' => 3,
            'user_id' => 28,
        ]);

        ProjectUser::create([
            'project_id' => 4,
            'user_id' => 32,
        ]);

        ProjectUser::create([
            'project_id' => 4,
            'user_id' => 36,
        ]);
        ProjectUser::create([
            'project_id' => 4,
            'user_id' => 40,
        ]);

        //Dept 2

        ProjectUser::create([
            'project_id' => 5,
            'user_id' => 8,
        ]);

        ProjectUser::create([
            'project_id' => 5,
            'user_id' => 11,
        ]);

        ProjectUser::create([
            'project_id' => 5,
            'user_id' => 13,
        ]);

        ProjectUser::create([
            'project_id' => 6,
            'user_id' => 17,
        ]);

        ProjectUser::create([
            'project_id' => 6,
            'user_id' => 21,
        ]);

        ProjectUser::create([
            'project_id' => 7,
            'user_id' => 25,
        ]);

        ProjectUser::create([
            'project_id' => 8,
            'user_id' => 29,
        ]);

        ProjectUser::create([
            'project_id' => 8,
            'user_id' => 33,
        ]);
        ProjectUser::create([
            'project_id' => 8,
            'user_id' => 37,
        ]);

        //3
        ProjectUser::create([
            'project_id' => 9,
            'user_id' => 9,
        ]);

        ProjectUser::create([
            'project_id' => 9,
            'user_id' => 14,
        ]);

        ProjectUser::create([
            'project_id' => 10,
            'user_id' => 18,
        ]);

        ProjectUser::create([
            'project_id' => 10,
            'user_id' => 22,
        ]);

        ProjectUser::create([
            'project_id' => 11,
            'user_id' => 26,
        ]);

        ProjectUser::create([
            'project_id' => 11,
            'user_id' => 30,
        ]);

        ProjectUser::create([
            'project_id' => 12,
            'user_id' => 38,
        ]);

        ProjectUser::create([
            'project_id' => 12,
            'user_id' => 42,
        ]);

        //4
        ProjectUser::create([
            'project_id' => 13,
            'user_id' => 10,
        ]);

        ProjectUser::create([
            'project_id' => 13,
            'user_id' => 15,
        ]);

        ProjectUser::create([
            'project_id' => 13,
            'user_id' => 19,
        ]);

        ProjectUser::create([
            'project_id' => 14,
            'user_id' => 23,
        ]);

        ProjectUser::create([
            'project_id' => 14,
            'user_id' => 27,
        ]);

        ProjectUser::create([
            'project_id' => 14,
            'user_id' => 31,
        ]);

        ProjectUser::create([
            'project_id' => 15,
            'user_id' => 35,
        ]);

        ProjectUser::create([
            'project_id' => 16,
            'user_id' => 39,
        ]);

        ProjectUser::create([
            'project_id' => 16,
            'user_id' => 43,
        ]);
        
        ProjectUser::create([
            'project_id' => 1,
            'user_id' => 20,
        ]);
        ProjectUser::create([
            'project_id' => 1,
            'user_id' => 28,
        ]);
        ProjectUser::create([
            'project_id' => 1,
            'user_id' => 36,
        ]);
        ProjectUser::create([
            'project_id' => 1,
            'user_id' => 16,
        ]);
    }
}
