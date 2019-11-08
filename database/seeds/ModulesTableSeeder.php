<?php

use App\Module;
use Illuminate\Database\Seeder;

class ModulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Loops 10 times to create 10 modules
        for($i = 1; $i <= 21; $i++) {
            $m = new Module;
            $m -> name = "CSM" . $i;
            $m -> description = "An example module";
            $m -> save();
            $m->users()->attach(rand(1, 10));
        }

        // * Create 20 random modules using the PostFactory
        factory(App\Module::class, 20)->create();
    }
}
