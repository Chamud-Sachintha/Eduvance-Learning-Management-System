<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Classes;
use App\Subject;
use App\Lesson;
use App\Document;

class DocumentController extends Controller
{
    public function showAddDocumentPage() {
        $available_classes = Classes::select('*')->get();
        $data = DB::table('documents')->select('documents.id','documents.document_title','documents.document_name','lessons.lesson_name')
                                ->join('lessons', 'lessons.id', '=', 'documents.lesson_id')
                                ->get();
        // dd($available_classes);
        $available_documents = json_decode($data, true);
        if (Session()->get('teacherStatus')) {
            return view('lecture_documents')->with(['classes'=>$available_classes, 'documents'=>$available_documents]);
        } else {
            return redirect('/login');
        }
    }

    public function findSubjectsForDocumentAdd(Request $request) {
        if (Session()->get('teacherStatus')['role'] == 'Admin' || Session()->get('teacherStatus')['role'] == 'admin') {
            $data = Subject::select('*')->where('class_id', $request->id)->get();
            return response()->json($data);
        } else {
            return redirect('/login');
        }
    }

    public function findLessonsForDocumentAdd(Request $request) {
        if (Session()->get('teacherStatus')['role'] == 'Admin' || Session()->get('teacherStatus')['role'] == 'admin') {
            $data = Lesson::select('*')->where('subject_id', $request->id)->get();

            return response()->json($data);
        } else {
            return redirect('/login');
        }
    }

    public function uploadSelectedDocuments(Request $request) {
        // dd($request);
        $document_table = new Document();

        if (Session()->get('teacherStatus')['role'] == 'Admin' || Session()->get('teacherStatus')['role'] == 'admin') {
            $document_table->document_title = $request->documentTitle;
            $document_table->class_id = $request->classGrade;
            $document_table->lesson_id = $request->lessonName;

            $file = $request->fileName;
            $get_file_name = date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('public/documents'), $get_file_name);
            $document_table->document_name = $get_file_name;

            $document_table->save();
            return redirect('/add-documents');
        } else {
            return redirect('/login');
        }
    }

    public function deleteSelectedDocument($id) {
        if (Session()->get('teacherStatus')['role'] == 'Admin' || Session()->get('teacherStatus')['role'] == 'admin') {
            Document::where('id',$id)->delete();

            return redirect('/add-documents');
        } else {
            return redirect('/login');
        }
    }
}
