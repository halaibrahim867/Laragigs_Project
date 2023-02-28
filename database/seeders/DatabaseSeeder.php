<?php

namespace Database\Seeders;

use App\Models\Listing;
use App\Models\User;
use Database\Factories\ListingFactory;
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
        // \App\Models\User::factory(5)->create();

        $user= User::factory()->create([
            'name'=>'Hala Ibrahim',
            'email'=>'halaibrahim867@gmail.com'
        ]);
         Listing::factory(6)->create([
             'user_id'=>$user->id
         ]);
    }
}
