<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Teacher;

class TeacherDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $teacher_table = new Teacher();

        $teacher_table->username = 'Kamal Perera';
        $teacher_table->email = 'kamalperera@gmail.com';
        $teacher_table->password = Hash::make('123');
        $teacher_table->role = 'Admin';

        $teacher_table->save();
    }
}
