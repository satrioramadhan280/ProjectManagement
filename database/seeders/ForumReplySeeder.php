<?php

namespace Database\Seeders;

use App\Models\ForumReply;
use Illuminate\Database\Seeder;

class ForumReplySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        ForumReply::create([
            'forum_id' => '1',
            'user_id' => 16,
            'description' => 'Ini Reply Kedua',
            'updated_at' => '2021-12-17 12:20:33',
        ]);

        ForumReply::create([
            'forum_id' => '1',
            'user_id' => 16,
            'description' => 'Ini reply pertama',
            'updated_at' => '2021-12-17 07:20:33',
        ]);
    }
}
