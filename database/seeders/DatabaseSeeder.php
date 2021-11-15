<?php

namespace Database\Seeders;

use App\Models\Board;
use App\Models\Category;
use App\Models\Comment;
use App\Models\DiscordServer;
use App\Models\Tag;
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
        Tag::factory(25)->create();

        //Create some categories.
        Category::factory(10)->create();

        //Create 10 users
        User::factory(10)->create()->each(function($user){

            //Create a random number of boards per user.
            Board::factory(rand(0, 2))->create(['user_id' => $user->id])->each(function($board) use ($user){

                //Create a random number of comments per board.
                Comment::factory(rand(0, 50))->create(['user_id' => $user->id, 'board_id' => $board->id]);
            });

            //Create a random number of discord servers per user. (Using for() to make each category unique)
            for($i = 0; $i < rand(0, 2); $i++) {
                DiscordServer::factory(1)->create(['user_id' => $user->id, 'category_id' => Category::all()->random()->id])->each(function($discord_server){

                    //Add a random amount of tags per discord server.
                    $discord_server->tags()->attach(Tag::inRandomOrder()->limit(rand(0, 8))->pluck('id')->toArray()); //TODO: Potential issue with 8?
                });
            }
        });
    }
}
