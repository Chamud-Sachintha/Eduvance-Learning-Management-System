<?php

namespace App\Http\Controllers;

use App\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Session;

class TeacherController extends Controller
{
    function showAdminDashboard(){
        $all_teachers = Teacher::select('*')->get();

        if(Session()->has('teacherStatus')){
            if(Session()->get('teacherStatus')["role"] == 'admin' || Session()->get('teacherStatus')["role"] == 'Admin'){
                return view('dashboard')->with(['all_teachers'=>$all_teachers]);
            }else{
                return redirect('/add_subject');
            }
        }else{
            Session()->flash('status', 'Please Login Before Access Admin Panel');

            return redirect('/login');
        }
    }

    function registerNewTeacher(Request $teacherDetails){
        $teacher_table = new Teacher();
        $check_res = Teacher::where(['email'=>$teacherDetails->email])->first();

        if($check_res){
            Session()->flash('status', 'User Already Exists.');

            return redirect('/admin_board');
        }
        else {
            if ($teacherDetails->username != null && $teacherDetails->email != null && $teacherDetails->pswd && $teacherDetails->teacherRole && $teacherDetails->con_pswd != null) {
                if ($teacherDetails->pswd == $teacherDetails->con_pswd) {
                    $teacher_table->username = $teacherDetails->username;
                    $teacher_table->email = $teacherDetails->email;
        
                    $teacher_table->password = Hash::make($teacherDetails->pswd);
                    $teacher_table->role = $teacherDetails->teacherRole;
        
                    $teacher_table->save();
                    Session()->flash('teacher', 'Teacher Registration Successfull. Please Login');
        
                    return redirect('/admin_board');
                } else {
                    Session()->flash('teacher', 'Password Not Match.');
    
                    return redirect('/admin_board');
                }
            } else {
                Session()->flash('teacher', 'Please Fill All Feilds');
    
                return redirect('/admin_board');
            }
        }
    }

    function showAllTeachers() {
        $all_teachers = Teacher::all();

        if (Session()->get('teacherStatus')) {
            return view('all_teachers')->with(['all_teachers'=>$all_teachers]);
        } else {
            Session()->flash('status', 'Access Denied.');

            return redirect('login');
        }
    }

    function showUpdateTeacherForm($teacherId) {
        $selected_teacher_details = Teacher::select('*')->where('id', $teacherId)->get();

        if (Session()->get('teacherStatus')) {
            return view('update_teacher')->with(['teacher_details'=>$selected_teacher_details]);
        } else {
            Session()->flash('status', 'Access Denied.');

            return redirect('login');
        }
    }

    function updateSelectedTeacherDetails (Request $updatedDetails) {
        if (Session()->get('teacherStatus')) {
            if ($updatedDetails->pswd != null && ($updatedDetails->pswd == $updatedDetails->con_pswd)){
                Teacher::where('id', $updatedDetails->teacherId)->update([
                    'username'=>$updatedDetails->username,
                    'email'=>$updatedDetails->email,
                    'password'=>Hash::make($updatedDetails->pswd),
                    'role'=>$updatedDetails->teacherRole
                ]);
            } else {
                Teacher::where('id', $updatedDetails->teacherId)->update([
                    'username'=>$updatedDetails->username,
                    'email'=>$updatedDetails->email,
                    'password'=>$updatedDetails->curPassword,
                    'role'=>$updatedDetails->teacherRole
                ]);
            }

            return redirect('/show-all-teachers');
        } else {
            Session()->flash('status', 'Access Denied.');

            return redirect('/login');
        }
    }

    function deleteSelectedTeacherDetails($teacherId) {
        if (Session()->get('teacherStatus')) {
            Teacher::where('id', $teacherId)->delete();

            return redirect('/show-all-teachers');
        } else {
            Session()->flash('status','Access Denied.');

            return redirect('/login');
        }
    }
}