<?php

use Illuminate\Database\Seeder;
use App\Module;
use App\User;

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
        $users = App\User::get();
        foreach($users as $user) {
            $module_ids = array_rand(DB::table('modules')->pluck('id')->toArray());
            if(empty($module_ids)) {
                $module_ids = 1;
                dump($module_ids);
            }
            $user->modules()->syncWithoutDetaching($module_ids);
        }
    }
}
