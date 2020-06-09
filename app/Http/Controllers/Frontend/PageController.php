<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\Page;
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

    public function get(Request $request)
    {

        $ssr = $this->render($request->path());
        dd($request);
        return view('app', ['ssr' => $ssr]);
    }
}