<?php

use App\Comment;
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
        $user_id = App\User::inRandomOrder()->first()->id;
        $c = new Comment;
        $c -> post_id = App\Post::inRandomOrder()->first()->id;
        $c -> user_id = $user_id;
        $c -> user_name = DB::table('users')->where('id', $user_id)->value('name');
        $c -> body = "This is an example comment! woohoo!";
        $c -> save();

        factory(App\Comment::class, 200)->create();
    }
}
