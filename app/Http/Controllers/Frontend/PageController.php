<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AccountCourse;
use App\Models\Courses;
use App\Models\Document;
use App\Models\Page;
use App\Models\Account;
use App\Models\Specialty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class PageController extends Controller
{

    public function index() {

        return view('app');
    }



    private function render($path)
    {

    }
    public function about(Request $request)
    {
        $about = Page::all();
        $document = DB::table('documents')->where('documents.page_id', '=', 1 )->get();
        return response()->json(['data'=>$about,'document'=>$document]);
    }

    public function coursestitle(Request $request)
    {
       $coursestitle = Courses::all();
       // $coursestitle = DB::table('courses')->get();

        return response()->json(['data'=>$coursestitle]);
    }
    public function applicantcount(Request $request)
    {
        $accounts = Account::where('role', '=', 'user')->get();
        $accountscount = $accounts->count();

        return response()->json(['data'=>$accountscount]);
    }
    public function coursescount(Request $request)
    {
        $courses = Courses::all();
        $coursescount = $courses->count();

        return response()->json(['data'=>$coursescount]);
    }
    public function allcourses(Request $request)
    {
        $courses = Courses::all();
        return response()->json(['data'=>$courses]);
    }
    public function coursedetails(Request $request,$id)
    {

        $courses = Courses::where("id",'=',$id)->get();
        $coursespeciality = $courses[0]->specialty_ids;
        if (isset($courses)) {
            if ($courses[0]->specialty_ids) {
                $spec_ids = json_decode($courses[0]->specialty_ids);
                for ($i = 0; $i < count($spec_ids); $i++) {
                    $specialtis = Specialty::query()->find($spec_ids[$i]);
                    $specialties_obj[] = ["id" => $specialtis->id,
                        "name" => $specialtis->name];
                }
            }
            //$courses["specialities"] = $specialties_obj;
        }
       // var_dump($specialties_obj);
        return response()->json(['data'=>$courses,'specialities'=>$specialties_obj]);
    }

public function savecomment(Request $request)
    {
         $course_id  = $request->course_id;
         $user_id  = $request->account_id;
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