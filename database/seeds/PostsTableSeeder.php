<?php

use App\Post;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $p = new Post;
        $p -> title = "Example Post ";
        $p -> user_id = App\User::inRandomOrder()->first()->id;
        $p -> body = "This is an example post";
        $p -> save();

        // * Create 50 random posts using the PostFactory
        factory(App\Post::class, 50)->create();
    }
}
