<?php

namespace App\Http\Controllers\Super;

use App\Http\Controllers\Controller;
use App\Models\SParent;
use App\Models\SMS;
use App\Models\Email;
use App\Models\Eclass;
use App\Models\Student;
use App\Mail\Communication;
use App\Http\Requests\SMSRequest;
use App\Http\Requests\EmailRequest;
use App\Models\Teacher;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $receivers = array(
            array('name' => 'Students', 'value' => 1),
            array('name' => 'Guardians', 'value' => 2),
            array('name' => 'Admin', 'value' => 3),
            array('name' => 'Teacher', 'value' => 4),
            array('name' => 'Accountant', 'value' => 5),
            array('name' => 'Librarian', 'value' => 6),
            array('name' => 'Receptionist', 'value' => 7),
            array('name' => 'Super Admin', 'value' => 8),
        );

        $classes = Eclass::all();

        return view('superadmin.email.compose', compact('receivers', 'classes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\EmailRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmailRequest $request)
    {
        if ($request->type == 'class') {
            $message = $request->message_class;
        } elseif ($request->type == 'individual') {
            $message = $request->message_individual;
        } else {
            $message = $request->message;
        }

        if (!empty($request->attachment)) {
            $file = $request->file('attachment');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move(public_path('uploads/attachment/'), $filename);
            $file_name = 'uploads/attachment/' . $filename;
        }
        $email = new Email();
        $email->name = $request->title;
        $email->type = $request->type;
        $email->attachment = $file_name;
        $email->message_to = json_encode($request->message_to);
        $email->message = $message;
        $email->message_to_type = ($request->message_to_type) ? $request->message_to_type : 0;

        if ($email->save()) {
            if ($request->type == 'group') {
                $message_tos = $request->message_to;
                foreach ($message_tos as $message_to) {
                    if ($message_to == 1) {
                        $students = Student::all();
                        foreach ($students as $student) {
                            Mail::to($student->email)->send(new Communication($email));
                        }
                    } elseif ($message_to == 2) {
                        $guardians = SParent::all();
                        foreach ($guardians as $guardian) {
                            Mail::to($guardian->guardian_email)->send(new Communication($email));
                            Mail::to($guardian->email)->send(new Communication($email));
                        }
                    } elseif ($message_to == 4) {
                        $teachers = Teacher::all();
                        foreach ($teachers as $teacher) {
                            Mail::to($teacher->email)->send(new Communication($email));
                        }
                    }
                }
            } else if ($request->type == 'class') {
                $students = Student::where('class_id', $request->class_id)->whereIn('section_id', $request->message_to)->get();
                foreach ($students as $student) {
                    Mail::to($student->email)->send(new Communication($email));
                }
            } else if ($request->type == 'individual') {
                if ($request->message_to_type == 1) {
                    $students = Student::whereIn('id', $request->message_to)->get();
                    foreach ($students as $student) {
                        Mail::to($student->email)->send(new Communication($email));
                    }
                } elseif ($request->message_to_type == 2) {
                    $guardians = Guardian::whereIn('id', $request->message_to)->get();
                    foreach ($guardians as $guardian) {
                        Mail::to($guardian->guardian_email)->send(new Communication($email));
                        Mail::to($guardian->email)->send(new Communication($email));
                    }
                } elseif ($request->message_to_type == 4) {
                    $teachers = Teacher::whereIn('id', $request->message_to)->get();
                    foreach ($teachers as $teacher) {
                        Mail::to($teacher->email)->send(new Communication($email));
                    }
                }
            }
            return redirect()->back()->with('success', 'Added successfully');
        } else {
            return redirect()->back()->with('error', 'Opps! Something went wrong');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createSMS()
    {
        $receivers = array(
            array('name' => 'Students', 'value' => 1),
            array('name' => 'Guardians', 'value' => 2),
            array('name' => 'Admin', 'value' => 3),
            array('name' => 'Teacher', 'value' => 4),
            array('name' => 'Accountant', 'value' => 5),
            array('name' => 'Librarian', 'value' => 6),
            array('name' => 'Receptionist', 'value' => 7),
            array('name' => 'Super Admin', 'value' => 8),
        );

        $classes = Eclass::all();

        return view('superadmin.sms.compose', compact('receivers', 'classes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\SMSRequest $request
     * @return \Illuminate\Http\Response
     */
    public function storeSMS(SMSRequest $request)
    {
        //dd($request->all());
        $sms = new SMS();
        $sms->name = $request->title;
        $sms->type = $request->type;
        $sms->send_through = json_encode($request->send_through);
        $sms->message_to = json_encode($request->message_to);
        $sms->message = $request->message;
        $sms->message_to_type = ($request->message_to_type) ? $request->message_to_type : 0;

        if ($sms->save()) {
            if ($request->type == 'group') {
                $message_tos = $request->message_to;
                foreach ($message_tos as $message_to) {
                    if ($message_to == 1) {
                        $students = Student::all()->pluck('phone');
                        foreach ($students as $student) {
                            sendSMSMultiple($student, $sms->message);
                        }
                    } elseif ($message_to == 2) {
                        $guardians = SParent::all()->pluck('father_contact');
                        foreach ($guardians as $guardian) {
                            sendSMSMultiple($guardian, $sms->message);
                        }

                        $mother_contacts = SParent::all()->pluck('mother_contact');
                        foreach ($mother_contacts as $mother_contact) {
                            sendSMSMultiple($mother_contact, $sms->message);
                        }

                        $guardian_contacts = SParent::all()->pluck('guardian_contact');
                        foreach ($guardian_contacts as $guardian_contact) {
                            sendSMSMultiple($guardian_contact, $sms->message);
                        }
                    } elseif ($message_to == 4) {
                        $teachers = Teacher::all()->pluck('phone');
                        foreach ($teachers as $teacher) {
                            sendSMSMultiple($teachers, $sms->message);
                        }
                    }
                }
            } else if ($request->type == 'class') {
                $students = Student::where('class_id', $request->class_id)->whereIn('section_id', $request->message_to)->pluck('phone');
                foreach ($students as $student) {
                    sendSMSMultiple($student, $sms->message);
                }
            } else if ($request->type == 'individual') {
                if ($request->message_to_type == 1) {
                    $students = Student::whereIn('id', $request->message_to)->pluck('phone');
                    foreach ($students as $student) {
                        sendSMSMultiple($student, $sms->message);
                    }
                } elseif ($request->message_to_type == 2) {
                    $guardians = SParent::all()->pluck('father_contact');
                    foreach ($guardians as $guardian) {
                        sendSMSMultiple($guardian, $sms->message);
                    }

                    $mother_contacts = SParent::all()->pluck('mother_contact');
                    foreach ($mother_contacts as $mother_contact) {
                        sendSMSMultiple($mother_contact, $sms->message);
                    }

                    $guardian_contacts = SParent::all()->pluck('guardian_contact');
                    foreach ($guardian_contacts as $guardian_contact) {
                        sendSMSMultiple($guardian_contact, $sms->message);
                    }
                } elseif ($request->message_to_type == 4) {
                    $teachers = Teacher::whereIn('id', $request->message_to)->pluck('phone');
                    foreach ($teachers as $teacher) {
                        sendSMSMultiple($teachers, $sms->message);
                    }
                }
            }
            return redirect()->back()->with('success', 'Added successfully');
        } else {
            return redirect()->back()->with('error', 'Opps! Something went wrong');
        }
    }
}

