<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\facades\DB;
use App\Classes;

class ClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('classes')->insert([
           
            ['name'=>'Grade 6','teacher_id'=>4],
            ['name'=>'Grade 7','teacher_id'=>4],
            ['name'=>'Grade 8','teacher_id'=>3],
            ['name'=>'Grade 9','teacher_id'=>2],
            ['name'=>'Grade 10','teacher_id'=>2],
            ['name'=>'Grade 11','teacher_id'=>1]


        ]);
    }
}
