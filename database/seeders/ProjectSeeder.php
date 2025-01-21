<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectSeeder extends Seeder
{
    public function run()
    {
        DB::table('projects')->insert([
            [
                'name' => 'Test Project',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer tincidunt tellus lorem, at aliquam metus varius vel. Vivamus viverra, urna quis volutpat luctus, erat mi lobortis turpis, a tempus lectus est eget purus. Etiam pulvinar congue vehicula. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse commodo, purus et tristique condimentum, elit ligula ultricies nulla, non vulputate justo sapien et dui. Nunc malesuada erat et ullamcorper eleifend. Praesent nec libero ullamcorper, sagittis leo nec, interdum nibh. Donec eu suscipit massa. Nulla a molestie nibh, nec porttitor ipsum. Sed finibus velit quis quam luctus lobortis. Sed eu nisl ut risus commodo.',
                'deadline' => '2025-01-27',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Project 2',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer tincidunt tellus lorem, at aliquam metus varius vel. Vivamus viverra, urna quis volutpat luctus, erat mi lobortis turpis, a tempus lectus est eget purus. Etiam pulvinar congue vehicula. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse commodo, purus et tristique condimentum, elit ligula ultricies nulla, non vulputate justo sapien et dui. Nunc malesuada erat et ullamcorper eleifend. Praesent nec libero ullamcorper, sagittis leo nec, interdum nibh. Donec eu suscipit massa. Nulla a molestie nibh, nec porttitor ipsum. Sed finibus velit quis quam luctus lobortis. Sed eu nisl ut risus commodo.',
                'deadline' => '2025-01-22',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
