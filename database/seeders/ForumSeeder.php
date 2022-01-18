<?php

namespace Database\Seeders;

use App\Models\Forum;
use Illuminate\Database\Seeder;

class ForumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Forum::create([
            'project_id' => '1',
            'user_id' => 16,
            'description' => 'Task satu selesai.',
            'updated_at' => '2021-12-17 07:20:33',
        ]);

        Forum::create([
            'project_id' => '1',
            'user_id' => 16,
            'description' => 'Task dua selesai.',
            'updated_at' => '2021-12-17 12:40:33',
        ]);

        Forum::create([
            'project_id' => '1',
            'user_id' => 16,
            'description' => 'Task empat selesai.',
            'updated_at' => '2021-12-17 17:20:33',
        ]);

        Forum::create([
            'project_id' => '1',
            'user_id' => 16,
            'description' => 'Task tiga selesai.',
            'updated_at' => '2021-12-17 15:20:33',
        ]);
    }
}
