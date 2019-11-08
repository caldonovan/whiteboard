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
        $u -> password = "123";
        $u -> isLecturer = false;
        $u -> save();

        // Create 50 random users using the UserFactory
        factory(App\User::class, 50)->create();
    }
}
