<?php

namespace App\Http\Controllers;

use App\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Subject;
use App\Classes;
use App\Comment;
use App\Document;
use App\VideoModel;
use Redirect;

class LessonController extends Controller
{
    function calculateLessonVideoViewCount($id) {
        $vedioModel = new VideoModel();

        if (Session()->has('member')) {
            $userId = Session()->get('member')['id'];
        } else if (Session()->has('teacherStatus')) {
            $userId = Session()->get('teacherStatus')['id'];
        } else {
            $userId = null;
        }

        $checkExist = VideoModel::select('*')->where(['userId'=>$userId, 'lessonId'=>$id])->first();

        if (empty($checkExist)) {
            $vedioModel->userId = $userId;
            $vedioModel->lessonId = $id;

            $vedioModel->save();
        }

        return Redirect::back()->with('message','Operation Successful !');
    }

    function getLessonVideoViewCount($id) {
       
    }

    function showAddlessonForm(){
        $available_classes = Classes::select('*')->get();
        $available_subjects = Subject::select('*')->distinct()->get();

        if(Session()->has('teacherStatus')){
            return view('lesson_mgmt')->with(['classes'=>$available_classes, 'subjects'=>$available_subjects]);
        }else{
            Session()->flash('status', 'Please Login Before Access Admin Panel.');
            return redirect('/login');
        }
    }

    function saveLessonDetails(Request $lessonDetails){
        $lesson_table = new Lesson();

        if($lessonDetails){
            //dd($lessonDetails);
            //dd( $lessonDetails->subjectName);
            $lesson_table->subject_id = $lessonDetails->subjectName;
            $lesson_table->lesson_name = $lessonDetails->lessonName;

            $file = $lessonDetails->lessonThumbnail;
            $get_thumbnail_file_name = date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('public/Image'), $get_thumbnail_file_name);
            $lesson_table->lesson_thumbnail = $get_thumbnail_file_name;
            $lesson_table->platform_link = empty($lessonDetails->platformLink) ? "N" : ($lessonDetails->platformLink);

            // $link_arr = explode("=", $lessonDetails->lessonLink);
            // $lesson_table->lesson_vedio_link = "https://www.youtube.com/embed/".$link_arr[1];
            //dd($lessonDetails);
            if (empty($lessonDetails->platformLink)) {
                $vedio_file = $lessonDetails->lessonLink;
                $get_vedio_file_name = $vedio_file->getClientOriginalName();
                $vedio_file-> move(public_path('public/vedios'), $get_vedio_file_name);
                $lesson_table->lesson_vedio_link = $get_vedio_file_name;
            } else {
                $lesson_table->lesson_vedio_link = "N";

                $link_arr = explode("=", $lessonDetails->platformLink);
                $lesson_table->platform_link = "https://www.youtube.com/embed/".$link_arr[1];
            }

            Subject::where('id',$lessonDetails->subjectName)
                        ->update([
                        'teacher_id'=>Session()->get('teacherStatus')['id']
                    ]);

            $lesson_table->save();
            Session()->flash('status', 'Lesson Added Successfully!.');
            return redirect('/add_lesson');
        }else{
            Session()->flash('status', 'Please Fill All Fields.');
            return redirect('/add_lesson');
        }
    }

    function showLessonPage(){
        Session()->flash('noFilter', 0);

        $classes = Classes::select('*')->get();
        $my_array = DB::table('lessons')->select('lessons.id as lesson_id','lessons.lesson_name','lessons.lesson_thumbnail','lessons.lesson_vedio_link',
                                'subjects.name','subjects.id')
                                ->join('subjects', 'subjects.id','=','lessons.subject_id')
                                ->join('teachers','teachers.id','=','subjects.teacher_id')->get();

        $distinct_subjects = Subject::select('*')->distinct()->get();

        $available_lessons = json_decode($my_array, true);

        return view('lessons')->with(['filter_lessons'=>$available_lessons,'classes'=>$classes, 'subjects'=>$distinct_subjects]);
    }

    function viewSingleLesson($lesson_id){
        if (Session()->has('member')) {
            $userId = Session()->get('member')['id'];
        } else if (Session()->has('teacherStatus')) {
            $userId = Session()->get('teacherStatus')['id'];
        } else {
            $userId = null;
        }

        $viewCount = VideoModel::select('*')->where(['lessonId'=>$lesson_id])->count();
        
        $get_all_comments = Comment::select('*')->where('lesson_id', $lesson_id)->get();
        $data = DB::table('lessons')->select('lessons.id as lesson_id','lessons.lesson_name','lessons.lesson_thumbnail','lessons.lesson_vedio_link','lessons.platform_link','subjects.id as subject_id','subjects.name','teachers.id as techer_id','teachers.username')
                            ->join('subjects', 'subjects.id','=','lessons.subject_id')
                            ->join('teachers', 'teachers.id','=','subjects.teacher_id')
                            ->where('lessons.id', $lesson_id)->get();
        $getDocuments = Document::select('*')->where('lesson_id', $lesson_id)->get();

        $lesson_details = json_decode($data, true);
        if(Session()->has('member') || Session()->has('teacherStatus')){
            return view('lesson_single')->with(['lesson_details'=>$lesson_details, 'all_comments'=>$get_all_comments, 'decoded_summery'=>'', 'lessonDocuments'=>$getDocuments, 'userId'=>$userId, 'viewCount'=>$viewCount]);
        }else{
            Session()->flash('status', 'Access Denied.');
            return redirect('/login');
        }
    }

    public function returnLessonPage() {
        return redirect('/lessons');
    }

    public static function filterLessons(Request $lessonDetails){
        $classes = Classes::select('*')->get();
        $distinct_subjects = Subject::select('*')->distinct()->get();
        $sql_string = "SELECT lessons.id as lesson_id,lessons.lesson_name,lessons.lesson_thumbnail,lessons.lesson_vedio_link,subjects.name,subjects.id FROM lessons JOIN subjects WHERE subjects.id = lessons.subject_id AND ";

        if($lessonDetails->gradeFilter != "any"){
            if($lessonDetails->subjectFilter != "any"){
                $sql_string .= " class_id=$lessonDetails->gradeFilter AND subject_id=$lessonDetails->subjectFilter";
            }else{
                $sql_string .= " class_id=$lessonDetails->gradeFilter";
            }
        }else if($lessonDetails->subjectFilter != "any"){
            $sql_string .= " subject_id=$lessonDetails->subjectFilter";
        }else{
            $sql_string = "SELECT lessons.id as lesson_id,lessons.lesson_name,lessons.lesson_thumbnail,lessons.lesson_vedio_link,subjects.name,subjects.id FROM lessons JOIN subjects WHERE subjects.id = lessons.subject_id";
        }

        $uuu = DB::select($sql_string);

        //dd($uuu);
        // dd($filtered_lessons);
        $filtered_lessons = json_decode(json_encode($uuu), true);
        return view('lessons')->with(['filter_lessons'=>$filtered_lessons, 'classes'=>$classes, 'subjects'=>$distinct_subjects]);
    }

    function findSubjects(Request $request){
        $data = Subject::select('name','id')->where('class_id', $request->id)->get();

        return response()->json($data);
    }

    function showAllLessons() {
        $all_lessons = DB::table('lessons')->select('lessons.id','lessons.lesson_name','subjects.name','subjects.class_id','teachers.username')
                        ->join('subjects', 'subjects.id','=','lessons.subject_id')
                        ->join('teachers', 'teachers.id','=','subjects.teacher_id')
                        ->get();

        $lessons = json_decode(json_encode($all_lessons), true);
        return view('all_lessons')->with(['all_lessons'=>$lessons]);
    }

    function showUpdateLessonForm($lessonId) {
        $all_classes = Classes::select('*')->get();
        $data = DB::table('lessons')->select('lessons.id','lessons.lesson_name','lessons.lesson_thumbnail','lessons.lesson_vedio_link','lessons.platform_link','classes.id as class_id','classes.name','subjects.id as sub_id','subjects.name as sub_name')
                ->join('subjects', 'subjects.id','=','lessons.subject_id')
                ->join('classes', 'classes.id','=','subjects.class_id')
                ->where('lessons.id','=',$lessonId)
                ->get();
        
        //dd($data);

        $selectedLesson = json_decode(json_encode($data), true);

        return view('update_lesson')->with(['selected_lesson'=>$selectedLesson, 'all_classes'=>$all_classes]);
    }

    function saveUpdatedLessonDetails(Request $updatedLessonDetails) {
        if(Session()->has('teacherStatus')){
            
            //dd($updatedLessonDetails);
            
            if (($updatedLessonDetails->lessonThumbnail == null)) {
                $link_arr = explode("=", $updatedLessonDetails->platform_link);
                // $lesson_table->platform_link = "https://www.youtube.com/embed/".$link_arr[1];
                
                if ($updatedLessonDetails->checkStatusV === "N") {
                    Lesson::where('id',$updatedLessonDetails->lesson_id)
                        ->update([
                        'subject_id'=>$updatedLessonDetails->subjectName, 
                        'lesson_name'=>$updatedLessonDetails->lessonName, 
                        'lesson_thumbnail'=>$updatedLessonDetails->currentImage,
                        'lesson_vedio_link'=> $updatedLessonDetails->checkStatusV,
                        'platform_link'=> "https://www.youtube.com/embed/".$link_arr[1]
                    ]);
                } else {
                    
                    Lesson::where('id',$updatedLessonDetails->lesson_id)
                        ->update([
                        'subject_id'=>$updatedLessonDetails->subjectName, 
                        'lesson_name'=>$updatedLessonDetails->lessonName, 
                        'lesson_thumbnail'=>$updatedLessonDetails->currentImage,
                        'lesson_vedio_link'=> ($updatedLessonDetails->lesson_vedio_link == null ? $updatedLessonDetails->checkStatusV : $updatedLessonDetails->lesson_vedio_link),
                        'platform_link'=>$updatedLessonDetails->checkStatusL
                    ]);
                }

                session()->flash('status', 'Subject Updated Successfully.!');
                return redirect('/show-all-lessons');
            } else {
                $link_arr = explode("=", $updatedLessonDetails->platform_link);
                // $lesson_table->platform_link = "https://www.youtube.com/embed/".$link_arr[1];

                if ($updatedLessonDetails->checkStatusV === "N") {
                    Lesson::where('id',$updatedLessonDetails->lesson_id)
                        ->update([
                        'subject_id'=>$updatedLessonDetails->subjectName, 
                        'lesson_name'=>$updatedLessonDetails->lessonName, 
                        'lesson_thumbnail'=>$updatedLessonDetails->lessonThumbnail,
                        'lesson_vedio_link'=> $updatedLessonDetails->checkStatusV,
                        'platform_link'=> "https://www.youtube.com/embed/".$link_arr[1]
                    ]);
                } else {
                    //dd($updatedLessonDetails);
                    Lesson::where('id',$updatedLessonDetails->lesson_id)
                        ->update([
                        'subject_id'=>$updatedLessonDetails->subjectName, 
                        'lesson_name'=>$updatedLessonDetails->lessonName, 
                        'lesson_thumbnail'=>$updatedLessonDetails->lessonThumbnail,
                        'lesson_vedio_link'=> $updatedLessonDetails->checkStatusV,
                        'platform_link'=>$updatedLessonDetails->checkStatusL
                    ]);
                }
            }

            session()->flash('status', 'Subject Updated Successfully.!');
            return redirect('/show-all-lessons');
        }else{
            Session()->flash('status', 'Access Denied');
        }
    }

    function deleteSelectedLesson($lessonId) {
        if(Session()->has('teacherStatus')){
            lesson::where('id',$lessonId)->delete();

            return redirect('/show-all-lessons');
        }else{
            Session()->flash('status', 'Access Denied.');
            return redirect('/login');
        }
    }
}
