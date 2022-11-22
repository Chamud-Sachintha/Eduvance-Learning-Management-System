<?php

namespace App\Http\Controllers;

use App\Classes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Teacher;

class ClassesController extends Controller
{
    public function createNewClass(Request $classDetails) {
        $class_table = new Classes;

        if (Session()->get('teacherStatus')['role'] == 'Admin' || Session()->get('teacherStatus')['role'] == 'admin') {
            $class_table->name = $classDetails->className;
            $class_table->teacher_id = $classDetails->teacherId;
            $class_table->save();

            Session()->flash('classStatus', "Class Added Successfully!.");
            return redirect('/admin_board');
        } else {
            return redirect('/login');
        }
    }

    public function getAllClasses() {
        $data = DB::table('classes')->select('classes.id','classes.name','classes.teacher_id','teachers.username')
                            ->join('teachers', 'classes.teacher_id', '=', 'teachers.id')->get();
        
        $all_subjects = json_decode($data, true);
        if (Session()->get('teacherStatus')['role'] == 'Admin' || Session()->get('teacherStatus')['role'] == 'admin') {
            return view('all_classes')->with('classes', $all_subjects);
        } else {
            return redirect('/login');
        }
    }

    public function showUpdateClassForm($id) {
        $data = DB::table('classes')->select('classes.id','classes.name','classes.teacher_id','teachers.username')
                            ->join('teachers', 'classes.teacher_id', '=', 'teachers.id')
                            ->where('classes.id', '=', $id)
                            ->get();
        $all_teachers = Teacher::select('*')->get();
        // dd($data);
        $selected_classDetails = json_decode($data, true);
        if (Session()->get('teacherStatus')['role'] == 'Admin' || Session()->get('teacherStatus')['role'] == 'admin') {
            return view('update_classes')->with(['selected_classDetails'=>$selected_classDetails, 'all_teachers'=>$all_teachers]);
        } else {
            return redirect('/login');
        }
    }

    public function updateSelectedClassDetails(Request $requestClassDetails) {
        if (Session()->get('teacherStatus')['role'] == 'Admin' || Session()->get('teacherStatus')['role'] == 'admin') {
            Classes::where('id', $requestClassDetails->classId)->update([
                'name'=>$requestClassDetails->className,
                'teacher_id'=>$requestClassDetails->teacherId
            ]);

            Session()->flash('status', "Class Details Update Successfully.");
        } else {
            return redirect('/login');
        }
    }

    public function deleteSelectedClassDetails($id) {
        if (Session()->get('teacherStatus')['role'] == 'Admin' || Session()->get('teacherStatus')['role'] == 'admin') {
            Classes::where('id', $id)->delete();
            
            return redirect('/all_classes');
        } else {
            return redirect('/login');
        }
    }
}
