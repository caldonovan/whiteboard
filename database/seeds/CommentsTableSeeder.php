<?php

use App\Comment;
use App\Post;
use App\User;
use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i <= 20; $i++) {
            $c = new Comment;
            $c -> post_id = rand(1, 10);
            $c -> user_id = rand(1, 10);
            $c -> body = "This is an example comment! woohoo!";
            $c -> save();
        }

        factory(App\Comment::class, 20)->create();
    }
}
