<?php

namespace Database\Seeders;

use App\Models\NotificationType;
use Illuminate\Database\Seeder;

class NotificationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        NotificationType::create([
            'id' => 1,
            'display' => "Assigned to Project",
        ]);

        NotificationType::create([
            'id' => 2,
            'display' => "Assigned to Task",
        ]);

        NotificationType::create([
            'id' => 3,
            'display' => "Removed From Project",
        ]);

        NotificationType::create([
            'id' => 4,
            'display' => "Removed From Task",
        ]);

        NotificationType::create([
            'id' => 5,
            'display' => "Project Created",
        ]);

        NotificationType::create([
            'id' => 6,
            'display' => "Project Deleted",
        ]);


        NotificationType::create([
            'id' => 7,
            'display' => "Project Status Updated",
        ]);
        
        NotificationType::create([
            'id' => 8,
            'display' => "Head Forum Notification",
        ]);

        NotificationType::create([
            'id' => 9,
            'display' => "Reply Forum",
        ]);
    }
}
