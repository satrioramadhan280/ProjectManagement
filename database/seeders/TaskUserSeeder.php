<?php

namespace Database\Seeders;

use App\Models\TaskUser;
use Illuminate\Database\Seeder;

class TaskUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        TaskUser::create([
            'task_id' => 1,
            'project_id' => '1',
            'user_id' => 28,
        ]);
        TaskUser::create([
            'task_id' => 1,
            'project_id' => '1',
            'user_id' => 20,
        ]);
        TaskUser::create([
            'task_id' => 1,
            'project_id' => '2',
            'user_id' => 36,
        ]);
        TaskUser::create([
            'task_id' => 1,
            'project_id' => '3',
            'user_id' => 28,
        ]);
        TaskUser::create([
            'task_id' => 1,
            'project_id' => '3',
            'user_id' => 36,
        ]);
        TaskUser::create([
            'task_id' => 1,
            'project_id' => '3',
            'user_id' => 20,
        ]);

        TaskUser::create([
            'task_id' => 2,
            'project_id' => '1',
            'user_id' => 7,
        ]);

        TaskUser::create([
            'task_id' => 3,
            'project_id' => '1',
            'user_id' => 7,
        ]);
    }
}
