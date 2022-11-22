<?php

use Illuminate\Database\Seeder;
use App\Comment;

class CommentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = new Comment;

        $data->student_id = '1';
        $data->display_name = 'User 01';
        $data->email_address = 'abv123@gmail.com';
        $data->message = 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it';

        $data->save();
    }
}
