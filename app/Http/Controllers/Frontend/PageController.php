<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\AccountCourse;
use App\Models\Courses;
use App\Models\Page;
use App\Models\Specialty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{

    public function index()
    {

        return view('app');
    }


    private function render($path)
    {

    }

    public function about(Request $request)
    {
        $about = Page::all();
        $document = DB::table('documents')->where('documents.page_id', '=', 1)->get();
        return response()->json(['data' => $about, 'document' => $document]);
    }

    public function coursestitle(Request $request)
    {
        $coursestitle = Courses::all();
        // $coursestitle = DB::table('courses')->get();

        return response()->json(['data' => $coursestitle]);
    }

    public function applicantcount(Request $request)
    {
        $accounts = Account::where('role', '=', 'user')->get();
        $accountscount = $accounts->count();

        return response()->json(['data' => $accountscount]);
    }

    public function coursescount(Request $request)
    {
        $courses = Courses::all();
        $coursescount = $courses->count();

        return response()->json(['data' => $coursescount]);
    }



    public function savecomment(Request $request)
    {
        $course_id = $request->course_id;
        $user_id = $request->account_id;
        $comment = $request->comment;
        try {
            $accountcourses = new AccountCourse();
            $accountcourses->course_id = $course_id;
            $accountcourses->account_id = $user_id;
            $accountcourses->comment = $comment;
            $accountcourses->panding = "unread";
            $accountcourses->save();
        } catch (\Exception $exception) {
            dd($exception);
            logger()->error($exception);
            // return redirect('backend/courses')->with('error', Lang::get('messages.wrong'));
        }

        return true;


    }

    public function get(Request $request)
    {

        $ssr = $this->render($request->path());
        return view('app', ['ssr' => $ssr]);
    }
}
