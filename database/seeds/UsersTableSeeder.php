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
        $u = new User;
        $u -> name = "John Doe";
        $u -> email = "johndoe@mail.co.uk";
        $u -> email_verified_at = now();
        $u -> password = bcrypt('12345678');
        $u -> isLecturer = false;
        $u -> remember_token = Str::random(10);
        $u -> save();

        // Create 50 random users using the UserFactory
        factory(App\User::class, 50)->create();
    }
}
