<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskSeeder extends Seeder
{
    public function run()
    {
        DB::table('tasks')->insert([
            [
                'project_id' => 1,
                'title' => 'Pembuatan Homepage',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer tincidunt tellus lorem, at aliquam metus varius vel. Vivamus viverra, urna quis volutpat luctus, erat mi lobortis turpis, a tempus lectus est eget purus. Etiam pulvinar congue vehicula. Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                'status' => 'completed',
                'due_date' => '2025-01-23',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'project_id' => 1,
                'title' => 'Pembuatan Halaman Keranjang',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer tincidunt tellus lorem, at aliquam metus varius vel. Vivamus viverra, urna quis volutpat luctus, erat mi lobortis turpis, a tempus lectus est eget purus. Etiam pulvinar congue vehicula.',
                'status' => 'completed',
                'due_date' => '2025-01-24',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'project_id' => 1,
                'title' => 'Halaman Sign in',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer tincidunt tellus lorem, at aliquam metus varius vel. Vivamus viverra, urna quis volutpat luctus, erat mi lobortis turpis, a tempus lectus est eget purus. Etiam pulvinar congue vehicula.',
                'status' => 'completed',
                'due_date' => '2025-01-24',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'project_id' => 2,
                'title' => 'Test Tugas 1',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer tincidunt tellus lorem, at aliquam metus varius vel. Vivamus viverra, urna quis volutpat luctus, erat mi lobortis turpis, a tempus lectus est eget purus.',
                'status' => 'not_started',
                'due_date' => '2025-01-22',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'project_id' => 2,
                'title' => 'Test Deadline 2',
                'description' => 'testtt',
                'status' => 'not_started',
                'due_date' => '2025-01-22',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'project_id' => 2,
                'title' => 'Test Alert Deadline 3',
                'description' => 'asdasddasdasdsad',
                'status' => 'not_started',
                'due_date' => '2025-01-21',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
