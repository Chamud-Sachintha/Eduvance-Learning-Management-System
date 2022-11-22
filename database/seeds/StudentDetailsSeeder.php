<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Student;

class StudentDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $table = new Student();

        $table->username = 'Chamud Sachintha';
        $table->email = 'sheraanmario777@gmail.com';
        $table->password = Hash::make('123');

        $table->save();
    }
}
