<?php

namespace Database\Seeders;

use App\Models\ForumReply;
use App\Models\NotificationType;
use App\Models\ProjectUser;
use App\Models\TaskUser;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            RoleSeeder::class,
            StatusSeeder::class,
            ProjectSeeder::class,
            ProjectUserSeeder::class,
            TaskSeeder::class,
            TaskUserSeeder::class,
            ForumSeeder::class,
            ForumReplySeeder::class,
            NotificationTypeSeeder::class,
        ]);
    }
}
