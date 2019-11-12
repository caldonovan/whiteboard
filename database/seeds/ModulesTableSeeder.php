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
        // Hard coded module for control test.
        $m = new Module;
        $m -> name = "CSM01";
        $m -> description = "An example module";
        $m -> save();

        // * Create 50 random modules using the ModuleFactory
        factory(App\Module::class, 49)->create();

    }
}
