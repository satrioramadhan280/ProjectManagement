<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Task::create([
            'project_id' => 1,
            'name' => 'Mengubah section account_maintenance_saving',
            'description' => 'Ini adalah task pertama'
        ]);
    }
}
