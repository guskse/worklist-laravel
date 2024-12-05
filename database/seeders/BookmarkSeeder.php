<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Job;
use App\Models\User;

class BookmarkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Get the testuser
        $testUser = User::where('email', 'test@email.com')->firstOrFail();

        //Get all job ids
        $jobIds = Job::pluck('id')->toArray();

        //randomly select job to bookmark (will get 3)
        $randomJobIds = array_rand($jobIds, 3);

        //attach selected jobs as bookmarks for testUser
        foreach ($randomJobIds as $jobId) {
            $testUser->bookmarkedJobs()->attach($jobIds[$jobId]);
        }
    }
}
