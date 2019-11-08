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
        for($i = 0; $i <= 10; $i++) {
            $p = new Post;
            $p -> title = "Example Post " . $i;
            $p -> body = "This is an example post";
            $p -> unique_views = 0;
            $p -> save();
        }
    }
}
