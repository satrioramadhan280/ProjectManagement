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
            'status' => 'Ongoing',
            'created_at' => '2022-03-02 09:54:11',
            'updated_at' => '2022-03-03 09:54:11',
            'percentage' => 30,
        ]);

        Task::create([
            'project_id' => 1,
            'name' => 'Membuat tabel high risk',
            'description' => 'Ini adalah task untuk membuat tabel high risk country',
            'status' => 'Ongoing',
            'created_at' => '2022-03-03 13:54:12',
            'updated_at' => '2022-03-06 13:54:12',
            'percentage' => 50,
        ]);

        Task::create([
            'project_id' => 1,
            'name' => 'Mengubah section account_maintenance_giro',
            'description' => 'Ini adalah task kedua',
            'status' => 'Ongoing',
            'created_at' => '2022-03-05 07:24:14',
            'updated_at' => '2022-03-12 07:24:14',
            'percentage' => 20,
        ]);

        Task::create([
            'project_id' => 2,
            'name' => 'Mengubah section account_maintenance_valas',
            'description' => 'Ini adalah task ketiga',
            'status' => 'Ongoing',
            'percentage' => 0,
        ]);
    }
}
