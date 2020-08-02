<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{

    public function uploadImage(Request $request)
    {

//        $rules = [
//            'video_id' => 'required',
//            'point' => 'required|numeric|min:0',
//            'status' => 'required|in:"finished","progress"',
//        ];
        $image = $request->file('images');

        $s3 = Storage::disk('s3');
        $filePath = '/images111/aasss.jpg' ;
        $s3->put($filePath, file_get_contents($image), 'public-read');
//        dd('File uploaded.....'.Storage::url($filepath));

//       $path = $request->file('images')->store("", "s3");

//        $validator = Validator::make($request->all(), $rules);
//
//        if ($validator->fails())
//        {
//            return response()->json($validator->errors());
//        }

        return response()->json($filePath);
    }
}
