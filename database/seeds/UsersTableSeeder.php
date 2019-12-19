<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create hardcoded user as control test
        $a = new User;
        $a -> name = "John Doe";
        $a -> email = "johndoe@mail.co.uk";
        $a -> email_verified_at = now();
        $a -> password = bcrypt('12345678');
        $a -> api_token = Str::random(80);
        $a -> isLecturer = true;
        $a -> isAdmin = true;
        $a -> remember_token = Str::random(10);
        $a -> save();

        // Create hardcoded user as control test
        $u = new User;
        $u -> name = "Jane Doe";
        $u -> email = "janedoe@mail.co.uk";
        $u -> email_verified_at = now();
        $u -> password = bcrypt('12345678');
        $u -> api_token = Str::random(80);
        $u -> isLecturer = false;
        $u -> isAdmin = false;
        $u -> remember_token = Str::random(10);
        $u -> save();

        // Create 50 random users using the UserFactory
        factory(App\User::class, 50)->create()->each(function ($user) {
            $user->modules()->save(factory(App\Post::class)->make());
        });
    }
}
