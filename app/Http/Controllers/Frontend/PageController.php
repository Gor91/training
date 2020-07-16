<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PageController extends Controller
{

    public function index() {

        return view('app');
    }



    private function render($path)
    {
      /*  $renderer_source = File::get(base_path('node_modules/vue-server-renderer/basic.js'));
        $app_source = File::get(public_path('js/entry-server.js'));
        $v8 = new \V8Js();
        ob_start();
        $js =
            <<<EOT
var process = { env: { VUE_ENV: "server", NODE_ENV: "production" } };
this.global = { process: process };
var url = "$path";
EOT;
        $v8->executeString($js);
        $v8->executeString($renderer_source);
        $v8->executeString($app_source);
         return ob_get_clean();*/
    }
    public function about(Request $request)
    {
        $about = Page::all();

       return response()->json(['data'=>$about]);
    }

    public function get(Request $request)
    {

        $ssr = $this->render($request->path());
        dd($request);
        return view('app', ['ssr' => $ssr]);
    }
}