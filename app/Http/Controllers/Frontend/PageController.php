<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Courses;
use App\Models\Document;
use App\Models\Page;
use App\Models\Account;
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
        return response()->json(['data'=>$courses]);
    }
    public function get(Request $request)
    {

        $ssr = $this->render($request->path());
        return view('app', ['ssr' => $ssr]);
    }
}