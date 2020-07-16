<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Email;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BaseController extends Controller
{
    public function sendEmail(Request $request)
    {
        $v = Validator::make($request->all(), [
            'subject' => 'required|max:255',
            'message' => 'required',
            'email' => 'required|email',
        ]);

        if (!$v->fails()) {
            $email = new Email();
            $email->account_id = $request->id;
            $email->subject = $request->subject;
            $email->message = $request->message;
            $email->created_by = Session::get('u_id');

            if ($email->save()) {
                $this->createEmail($request);
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
        $objSend->sender = 'Medical training HR Team';

        Mail::to($request->email)->send(new \App\Mail\SendEmail($objSend));

    }


    public function ajaxImageUpload(Request $request)
    {

        if ($request->isMethod('get'))
            return view('backend.ajax_image_upload');
        else {
            $validator = Validator::make($request->all(),
                [
                    'file' => 'image',
                ],
                [
                    'file.image' => 'The file must be an image (jpeg, png, bmp, gif, or svg)'
                ]);
            if ($validator->fails())
                return array(
                    'fail' => true,
                    'errors' => $validator->errors()
                );

            $extension = $request->file('file')->getClientOriginalExtension();

//            if (!file_exists( Config::get('constants.AVATAR_PATH'))) {
//                mkdir(Config::get('constants.AVATAR_PATH'), 0775, true);
//            }

            $dir = public_path() . Config::get('constants.AVATAR_PATH');
            $filename = 'avatar_' . $request->id . '.' . $extension;
            $request->file('file')->move($dir, $filename);
            $user = Account::find($request->id);
            $avatar_path = $dir . $user->image_name;

            if (preg_match('/\d+/',$user->image_name) != 0 ||
                file_exists(public_path() . Config::get('constants.AVATAR_PATH') . $user->image_name))
                unlink($avatar_path);
            $user->image_name = $filename;
            Account::where('id', $request->id)
                ->update(['image_name' => $filename]);
            return $filename;
        }
    }

    public function ajaxRemoveImage(Request $request)
    {

        $dir =  Config::get('constants.AVATAR_PATH');
        $user = Account::find($request->id);
        $avatar_path = public_path().$dir . $user->image_name;
        if (!file_exists($avatar_path))
            unlink($avatar_path);
        $user->image_name = 'default.jpg';
        $user->save();
    }
}