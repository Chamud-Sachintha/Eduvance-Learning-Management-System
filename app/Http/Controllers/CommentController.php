<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class CommentController extends Controller
{
    function saveCommentDetails(Request $commentDetails) {
        $comment_table = new Comment;

        if (Session()->get('member') || Session()->get('teacherStatus')) {
            $comment_table->student_id = (empty(Session()->get('member')['id'])) ? Session()->get('teacherStatus')['id'] : Session()->get('member')['id'];
            $comment_table->display_name = $commentDetails->username;
            $comment_table->email_address = $commentDetails->email;
            $comment_table->message = $commentDetails->comment;
            $comment_table->lesson_id = $commentDetails->lessonId;

            $comment_table->save();
            return redirect()->back()->with('message','Operation Successful !');

        } else {
            Session()->flash('status', 'Access Denied.');
            return redirect('/login');
        }
    }
}
