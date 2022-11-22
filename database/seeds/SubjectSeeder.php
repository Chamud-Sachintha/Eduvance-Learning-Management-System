<?php

use Illuminate\Database\Seeder;
use Illuminate\support\Facades\DB;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subjects')->insert([
            [
                'name'=>'Subject 01',
                'teacher_id'=>1,
                'class_id'=>1
            ],
            [
                'name'=>'Subject 02',
                'teacher_id'=>1,
                'class_id'=>2
            ],
            [
                'name'=>'Subject 03',
                'teacher_id'=>2,
                'class_id'=>4
            ],
            [
                'name'=>'Subject 04',
                'teacher_id'=>3,
                'class_id'=>6
            ],
            [
                'name'=>'Subject 05',
                'teacher_id'=>4,
                'class_id'=>7
            ],
            [
                'name'=>'Subject 06',
                'teacher_id'=>4,
                'class_id'=>6
            ]
        ]);
    }
}
