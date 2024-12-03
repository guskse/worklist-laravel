<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;



class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Load job listings from the file
        $jobListings = include database_path('seeders/data/job_listings.php');

        //get test user id (from test user seeder)
        $testUserId = User::where('email', 'test@email.com')->value('id');


        //get all other user ids from user model
        $userIds = User::where('email', '!=', 'test@email.com')->pluck('id')->toArray();

        foreach ($jobListings as $index => &$listing) {

            if ($index < 2) {
                //assign the first two job listings to test user
                $listing['user_id'] = $testUserId;
            } else {
                //assign user to listing
                $listing['user_id'] = $userIds[array_rand($userIds)];
            }
            //add timestamps
            $listing['created_at'] = now();
            $listing['updated_at'] = now();
        }

        //insert job listings
        DB::table('job_listings')->insert($jobListings);
        echo 'jobs created successfully through jobseeder';
    }
}
