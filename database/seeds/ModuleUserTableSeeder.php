<?php

use Illuminate\Database\Seeder;

class ModuleUserTableSeeder extends Seeder
{
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // * Seed the ModuleUser pivot table with existing values picked randomly from an array
        // * Get all the users in the user table
        $users = App\User::get();
        
        foreach($users as $user) {
            // * Retrieve all the ID's from the modules table in a random order, and convert to an array
            $module_ids = array_rand(DB::table('modules')->pluck('id')->toArray());
            
            // * If a module ID is null, change to 1 (Workaround at the moment)
            if(empty($module_ids)) {
                $module_ids = 1;
                dump($module_ids);
            }
            // * Sync the pivot table with the module ID's
            $user->modules()->syncWithoutDetaching($module_ids);
        }
    }
}
