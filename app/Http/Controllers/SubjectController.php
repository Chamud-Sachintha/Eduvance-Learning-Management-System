<?php

namespace App\Http\Controllers;

use App\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Classes;
use App\Teacher;

class SubjectController extends Controller
{
    function showAddSubjectForm(){
        $fetched_teachers = Teacher::select('*')->get();
        $fetched_classes = Classes::select('*')->get();

        if(Session()->has('teacherStatus')){
            return view('subject_mgmt')->with(['teachers'=>$fetched_teachers, 'classes'=>$fetched_classes]);
        }else{
            Session()->flash('status', 'Please Login Before Access The Admin Panel');
            return redirect('/login');
        }
    }

    function saveSubjectDetails(Request $subjectDetails){
        $subject_table = new Subject();
        $check_subject = Subject::where([['name','=',$subjectDetails->subjectName],['class_id','=',$subjectDetails->classGrade]])->first();

        if($check_subject){
            Session()->flash('status', 'Subject Already Exists.');
            return redirect('/add_subject');
        }else{
            if ($subjectDetails->subjectName != null && $subjectDetails->teacherId != null && $subjectDetails->classGrade) {
                $subject_table->name = $subjectDetails->subjectName;
                $subject_table->teacher_id = $subjectDetails->teacherId;
                $subject_table->class_id = $subjectDetails->classGrade;
    
                $subject_table->save();
    
                Session()->flash('status', 'Subject Added Successfully.');
                return redirect('/add_subject');
            } else {
                Session()->flash('status', 'Please Fill All Feilds.');
                return redirect('/add_subject');
            }
        }
    }

    function showAllSubjects(){
        $data = DB::table('subjects')->select('subjects.id','subjects.name','teachers.username','subjects.class_id','subjects.teacher_id')
                            ->join('teachers', 'subjects.teacher_id', '=', 'teachers.id')->get();
        
        $all_subjects = json_decode($data, true);
        
        if(Session()->has('teacherStatus')){
            return view('all_subjects')->with('subjects', $all_subjects);
        }else{
            Session()->flash('status', 'Please Login Before Access Admin Panel.');
            return redirect('/login');
        }
    }

    function showUpdateSubjectForm($subjectId){
        $fetched_teacher_result = Teacher::select('*')->get();
        $fetched_classes_result = Classes::select('*')->get();
        $data = DB::table('subjects')->select('subjects.id','subjects.name','subjects.teacher_id','subjects.class_id','teachers.username')
                            ->join('teachers', 'subjects.teacher_id','=','teachers.id')->where('subjects.id','=',$subjectId)->get();

        $fetched_subject_result = json_decode($data, true);
        //dd($fetched_subject_result);
        return view('update_subject')->with(['selectedSubject'=>$fetched_subject_result, "allTeachers"=>$fetched_teacher_result, 
                        'allClasses'=>$fetched_classes_result]);
    }

    function saveUpdatedSubjectDetails(Request $updatedDetails){
        //dd($updatedDetails);
        if(Session()->has('teacherStatus')){
            Subject::where('id',$updatedDetails->subject_Id)->update(
                [
                    'name'=>$updatedDetails->subjectName, 
                    'teacher_id'=>$updatedDetails->teacher_id, 
                    'class_id'=>$updatedDetails->class_id
                ]);

            session()->flash('status', 'Subject Updated Successfully.!');
            return redirect('/show_all_subjects');
        }else{
            Session()->flash('status', 'Access Denied');
        }
    }

    function deleteSelectedSubject($subject_id){
        if(Session()->has('teacherStatus')){
            Subject::where('id',$subject_id)->delete();

            return redirect('/show_all_subjects');
        }else{
            Session()->flash('status', 'Access Denied.');
            return redirect('/login');
        }
    }
}
