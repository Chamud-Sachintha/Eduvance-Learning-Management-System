<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ContactDetail;
use App\Feedback;

class ContactDetailController extends Controller
{
    public function returnAddContactDetailsPage() {
        $feedback_data = Feedback::select('*')->get();

        if(Session()->has('teacherStatus')){
            if(Session()->get('teacherStatus')["role"] == 'admin' || Session()->get('teacherStatus')["role"] == 'Admin'){
                return view('add_contact_details')->with(['feedback_data'=>$feedback_data]);
            }else{
                return redirect('/add_subject');
            }
        }else{
            Session()->flash('status', 'Please Login Before Access Admin Panel');

            return redirect('/login');
        }
    }

    public function saveContactDetails(Request $contactDetails) {
        $contact_details_table = new ContactDetail();
        // dd($contactDetails);
        if (($contactDetails->schoolName != null) && ($contactDetails->address != null) && ($contactDetails->responsiblePerson != null) &&
                ($contactDetails->telNo != null)) {
            $contact_details_table->school_name = $contactDetails->schoolName;
            $contact_details_table->school_address = $contactDetails->address;
            $contact_details_table->admin_name = $contactDetails->responsiblePerson;
            $contact_details_table->admin_tel = $contactDetails->telNo;

            $contact_details_table->save();
            return redirect('/add-contact');
        } else {
            Session()->flash('status', "Please Provide Correct Values");
            return redirect('/add-contact');
        }
    }

    public function saveUserFeedbackDetail(Request $feedback) {
        $feedback_table = new Feedback();

        if ($feedback->fname != null && $feedback->lname != null && $feedback->mailAddress != null && $feedback->tel != null && $feedback->message != null) {
            $feedback_table->full_name = $feedback->fname . " " . $feedback->lname;
            $feedback_table->email_address = $feedback->mailAddress;
            $feedback_table->tel_no = $feedback->tel;
            $feedback_table->message = $feedback->message;

            $feedback_table->save();
            Session()->flash('success', 'Message Send Successfully.');
            return redirect('/contact');
        } else {
            Session()->flash('faild', 'Please Fill All Required Feilds.');
            return redirect('/contact');
        }
    }

    public function returnShowContactDetailsPage() {
        $contact_details = ContactDetail::select('*')->get();
        //dd($contact_details->id);
        return view('contact')->with(['contact_details'=>$contact_details]);
    }

    public function deleteStudentFeedback($id) {
        Feedback::where('id',$id)->delete();

        return redirect('/add-contact');
    }
}
