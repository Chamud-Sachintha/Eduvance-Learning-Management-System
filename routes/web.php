<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\Student;
use App\Teacher;
use App\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Classes;
use App\Subject;

Route::get('/', function () {
    return view('mainpagenew');
});

Route::get('/main', function() {
    return view('index');
});

Route::get('/login', 'StudentController@showLoginPage');

Route::get('/logout', 'StudentController@memberLogout');

Route::post('/add_student', 'StudentController@registerNewStudent');

Route::post('/add_teacher', 'TeacherController@registerNewTeacher');

Route::post('/signin', 'StudentController@memberLogin');

Route::get('/admin_board', 'TeacherController@showAdminDashboard');

Route::get('/add_subject', 'SubjectController@showAddSubjectForm');

Route::get('/show_all_subjects', 'SubjectController@showAllSubjects');

Route::post('/save_subject', 'SubjectController@saveSubjectDetails');

Route::get('/add_lesson', 'LessonController@showAddlessonForm');

Route::post('/save_lesson', 'LessonController@saveLessonDetails');

Route::get('/lessons', 'LessonController@showLessonPage');

Route::get('/lesson/{lesson_id}', 'LessonController@viewSingleLesson');

Route::get('/update_subject/{id}', function ($id) {
    $fetched_teacher_result = Teacher::select('*')->get();
    $fetched_classes_result = Classes::select('*')->get();
    $data = DB::table('subjects')->select('subjects.id','subjects.name','subjects.teacher_id','subjects.class_id','teachers.username')
                        ->join('teachers', 'subjects.teacher_id','=','teachers.id')->where('subjects.id','=',$id)->get();

    $fetched_subject_result = json_decode($data, true);
    //dd($fetched_subject_result);
    return view('update_subject')->with(['selectedSubject'=>$fetched_subject_result, "allTeachers"=>$fetched_teacher_result, 
                    'allClasses'=>$fetched_classes_result]);
});

Route::post('/filter_lessons', 'LessonController@filterLessons');

Route::get('/filter_lessons', 'LessonController@returnLessonPage');

Route::get('/findSubjects', 'LessonController@findSubjects');

Route::post('/set_update_sub', 'SubjectController@saveUpdatedSubjectDetails');

Route::get('/delete_subject/{id}' ,function ($id) {
    if(Session()->has('teacherStatus')){
        Subject::where('id',$id)->delete();

        return redirect('/show_all_subjects');
    }else{
        Session()->flash('status', 'Access Denied.');
        return redirect('/login');
    }
});

Route::get('/show-all-lessons', 'LessonController@showAllLessons');

Route::get('/update_lesson/{id}', function ($id) {
    $all_classes = Classes::select('*')->get();
    $data = DB::table('lessons')->select('lessons.id','lessons.lesson_name','lessons.lesson_thumbnail','lessons.lesson_vedio_link','lessons.platform_link','classes.id as class_id','classes.name','subjects.id as sub_id','subjects.name as sub_name')
            ->join('subjects', 'subjects.id','=','lessons.subject_id')
            ->join('classes', 'classes.id','=','subjects.class_id')
            ->where('lessons.id','=',$id)
            ->get();
    
    //dd($data);

    $selectedLesson = json_decode(json_encode($data), true);

    return view('update_lesson')->with(['selected_lesson'=>$selectedLesson, 'all_classes'=>$all_classes]);
});

Route::post('/set_update_lesson', 'LessonController@saveUpdatedLessonDetails');

Route::get('/delete_lesson/{id}', function ($id) {
    if(Session()->has('teacherStatus')){
        lesson::where('id',$id)->delete();

        return redirect('/show-all-lessons');
    }else{
        Session()->flash('status', 'Access Denied.');
        return redirect('/login');
    }
});

Route::get('/show-all-students', 'StudentController@showAllStudents');

Route::get('/show-all-teachers', 'TeacherController@showAllTeachers');

Route::get('/update_teacher/{id}', function($id) {
    $selected_teacher_details = Teacher::select('*')->where('id', $id)->get();

    if (Session()->get('teacherStatus')) {
        return view('update_teacher')->with(['teacher_details'=>$selected_teacher_details]);
    } else {
        Session()->flash('status', 'Access Denied.');

        return redirect('login');
    }
});

Route::post('/set_update_teacher', 'TeacherController@updateSelectedTeacherDetails');

Route::get('/delete_teacher/{id}', function($id) {
    if (Session()->get('teacherStatus')) {
        Teacher::where('id', $id)->delete();

        return redirect('/show-all-teachers');
    } else {
        Session()->flash('status','Access Denied.');

        return redirect('/login');
    }
});

Route::get('/update_student/{id}', function($id) {
    //dd($id);
    if (Session()->get('teacherStatus')) {
        $selected_student = Student::where('id', $id)->get();

        return view('update_student')->with(['selected_student'=>$selected_student]);
    } else {
        Session()->flash('status', 'Access Denied.');
        return redirect('/login');
    }
});

Route::post('/set_update_student', 'StudentController@updateSelectedStudentDetails');

Route::get('/delete_student/{id}', function($id) {
    if (Session()->get('teacherStatus')) {
        Student::where('id', $id)->delete();

        return redirect('/show-all-students');
    } else {
        Session()->flash('status', 'Access Denied.');
        return redirect('/login');
    }
});

Route::get('/post_comment', 'CommentController@saveCommentDetails');

Route::post('/generate', 'GenerateSummeryController@generateSummery');

Route::get('/add-contact', 'ContactDetailController@returnAddContactDetailsPage');

Route::get('/contact', 'ContactDetailController@returnShowContactDetailsPage');

Route::post('/save_contact', 'ContactDetailController@saveContactDetails');

Route::post('/save_feedback', 'ContactDetailController@saveUserFeedbackDetail');

Route::get('/delete_feedback/{id}', 'ContactDetailController@deleteStudentFeedback');

Route::get('/add-documents', 'DocumentController@showAddDocumentPage');

Route::post('/add_class', 'ClassesController@createNewClass');

Route::get('/all_classes', 'ClassesController@getAllClasses');

Route::get('/show-update-class/{id}', 'ClassesController@showUpdateClassForm');

Route::post('/update_class', 'ClassesController@updateSelectedClassDetails');

Route::get('/delete-class/{id}', 'ClassesController@deleteSelectedClassDetails');

Route::get('/findSubjectsForDocumentAdd','DocumentController@findSubjectsForDocumentAdd');

Route::get('/findLessonsForDocumentAdd', 'DocumentController@findLessonsForDocumentAdd');

Route::post('/upload-documents', 'DocumentController@uploadSelectedDocuments');

Route::get('/delete-document/{id}', 'DocumentController@deleteSelectedDocument');

Route::get('/test/{id}', 'LessonController@calculateLessonVideoViewCount')->name('test');

Route::get('/getViewCount/{id}', 'LessonController@getLessonVideoViewCount');