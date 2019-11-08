<?php

use App\Course;
use Illuminate\Database\Seeder;

class CourseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        

        for($i = 1; $i <= 9; $i++) {
            $c = new Course;
            $c -> name = "CS" . $i;
            $c -> save();
        }
    }
}
