<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Ongoing, SIT - Ongoing, UAT - Ongoing, Live
        // Completed, SIT - Completed, UAT - Completed
        $statuses = ['Development - Ongoing', 'Development - Completed', 'SIT - Ongoing', 'SIT - Completed', 'UAT - Ongoing', 'UAT - Completed', 'Live'];
        foreach ($statuses as $status) {
            Status::create([
                'name' => $status,
            ]);
        }

    }
}
