<?php

namespace Database\Seeders;

use App\Models\Boards;
use App\Models\Categories;
use App\Models\Comments;
use App\Models\DiscordServers;
use App\Models\Tags;
use App\Models\User;
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

        //Create some tags.
        Tags::factory(25)->create();

        //Create some categories.
        Categories::factory(10)->create();

        //Create 10 users
        User::factory(10)->create()->each(function($user){

            //Create a random number of boards per user.
            Boards::factory(rand(0, 2))->create(['user_id' => $user->id])->each(function($board) use ($user){

                //Create a random number of comments per board.
                Comments::factory(rand(0, 50))->create(['user_id' => $user->id, 'board_id' => $board->id]);
            });

            //Create a random number of discord servers per user. (Using for() to make each category unique)
            for($i = 0; $i < rand(0, 2); $i++) {
                DiscordServers::factory(1)->create(['user_id' => $user->id, 'category_id' => Categories::all()->random()->id])->each(function($discord_server){

                    //Add a random amount of tags per discord server.
                    $discord_server->tags()->attach(Tags::inRandomOrder()->limit(rand(0, 8))->pluck('id')->toArray()); //TODO: Potential issue with 8?
                });
            }
        });
    }
}
