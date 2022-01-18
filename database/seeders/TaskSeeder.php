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
        
        Task::create([
            'project_id' => 1,
            'name' => 'Mengubah section account_maintenance_saving',
            'description' => 'Ini adalah task pertama',
            'status' => 'Ongoing'
        ]);

        Task::create([
            'project_id' => 1,
            'name' => 'Membuat tabel high risk',
            'description' => 'Ini adalah task untuk membuat tabel high risk country',
            'status' => 'Ongoing'
        ]);

        Task::create([
            'project_id' => 1,
            'name' => 'Mengubah section account_maintenance_giro',
            'description' => 'Ini adalah task kedua',
            'status' => 'Ongoing'
        ]);

        Task::create([
            'project_id' => 2,
            'name' => 'Mengubah section account_maintenance_valas',
            'description' => 'Ini adalah task ketiga',
            'status' => 'Ongoing'
        ]);
    }
}
