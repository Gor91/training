<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Email;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class BaseController extends Controller
{
    public function sendEmail(Request $request)
    {
        $v = Validator::make($request->all(), [
            'subject' => 'required|max:255',
            'message' => 'required',
            'email.*' => 'required|email',
        ]);

        if (!$v->fails()) {
            if (is_array($request->email)) {
                $this->createEmail($request);
            } else {
                $email = new Email();
                $email->resume_id = $request->id;
                $email->subject = $request->subject;
                $email->message = $request->message;
                $email->created_by = Session::get('u_id');

                if ($email->save()) {
                    $this->createEmail($request);
                }
            }
            return redirect()->back()->with('success', "success");
        } else
            return redirect()->back()->withErrors($v->errors());
    }

    public function createEmail($request)
    {
        $objSend = new \stdClass();
        $objSend->subject = $request->subject;
        $objSend->receiver = $request->name;
        $objSend->message = $request->message;
        $objSend->sender = 'Basic Corporation  HR Team';
        Mail::to($request->email)->send(new \App\Mail\SendEmail($objSend));

    }
}
