<?php

namespace App\Http\Controllers;

use App\Student;
use App\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Session;

class StudentController extends Controller
{
    function registerNewStudent(Request $studentDetails){
        $student_table = new Student();
        $check_res = Student::where(['email'=>$studentDetails->email])->first();

        if($check_res){
            Session()->flash('status', 'User is Already Exists.');

            return redirect('/admin_board');
        }
        else{
            if ($studentDetails->pswd != null && $studentDetails->username != null && $studentDetails->email && $studentDetails->con_pswd != null) {
                if ($studentDetails->pswd == $studentDetails->con_pswd) {
                    $hashedPassword = Hash::make($studentDetails->pswd);

                    $student_table->username = $studentDetails->username;
                    $student_table->email = $studentDetails->email;
                    $student_table->password = $hashedPassword;
        
                    $student_table->save();
                    Session()->flash('status', 'Student Registration Successfull. Please Login');
        
                    return redirect('/admin_board');
                } else {
                    Session()->flash('status', 'Password Doesn\'t Match,');
    
                    return redirect('/admin_board');
                }
            } else {
                Session()->flash('status', 'Please Fill All Feilds Before Registration');
    
                return redirect('/admin_board');
            }
        }
    }

    function showLoginPage(){
        return view('login');
    }

    // function showRegisterPage(){
    //     return view('student_register');
    // }

    function memberLogout(){
        Session()->forget('member');
        Session()->forget('teacherStatus');

        return redirect('/main');
    }

    function memberLogin(Request $member_details){
        $fetched_student_result = Student::where(['email'=>$member_details->email])->first();
        $fetched_teacher_result = Teacher::where(['email'=>$member_details->email])->first();
        if($fetched_student_result){
            if(!Hash::check($member_details->pswd,$fetched_student_result->password)){
                Session()->flash('status', 'Invalid Username or Password');

                return redirect('/login');
            }else{
                Session()->put('member', $fetched_student_result);
                return redirect('/main');
            }
        }else if($fetched_teacher_result){
            if(!Hash::check($member_details->pswd, $fetched_teacher_result->password)){
                Session()->flash('status', 'Invalid Username or Password');
                return redirect('/login');
            }else if($fetched_teacher_result->role == 'Admin'){
                Session()->put('teacherStatus', $fetched_teacher_result);
                return redirect('/main');
            }else{
                Session()->put('teacherStatus', $fetched_teacher_result);
                return redirect('/main');
            }
        }else{
            Session()->flash('status', 'Invalid Username or Password');

            return redirect('/login');
        }
    }

    function showAllStudents() {
        $all_students = Student::all();

        if (Session()->get('teacherStatus')) {
            return view('all_students')->with(['all_students'=>$all_students]);
        } else {
            Session()->flash('status', 'Access Denied.');

            return redirect('/login');
        }
    }

    function showUpdateStudentForm(string $studentId) {
        dd($studentId);
        if (Session()->get('teacherStatus')) {
            $selected_student = Student::where('id', $studentId)->get();

            return view('update_student')->with(['selected_student'=>$selected_student]);
        } else {
            Session()->flash('status', 'Access Denied.');
            return redirect('/login');
        }
    }

    function updateSelectedStudentDetails(Request $studentDetails) {
        if (Session()->get('teacherStatus')) {
            if ($studentDetails->pswd !=null && ($studentDetails->pswd == $studentDetails->con_pswd)) {
                Student::where('id', $studentDetails->studentId)->update([
                    'username'=>$studentDetails->username,
                    'email'=>$studentDetails->email,
                    'password'=>Hash::make($studentDetails->pswd)
                ]);
            } else {
                Student::where('id', $studentDetails->studentId)->update([
                    'username'=>$studentDetails->username,
                    'email'=>$studentDetails->email,
                    'password'=>$studentDetails->curPassword
                ]);
            }

            return redirect('/show-all-students');
        } else {
            Session()->flash('status', 'Access Denied');
            return redirect('/login');
        }
    }

    function deleteSelectedStudentDetails($studentId) {
        if (Session()->get('teacherStatus')) {
            Student::where('id', $studentId)->delete();

            return redirect('/show-all-students');
        } else {
            Session()->flash('status', 'Access Denied.');
            return redirect('/login');
        }
    }
}
