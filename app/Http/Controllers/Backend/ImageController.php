<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Videos;
use Illuminate\Http\Request;
use Illuminate\Log\Logger;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images = Storage::disk('s3')->allFiles('images');

        return view('backend.image.index', compact('images'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            return view('backend.image.create');
        } catch (\Exception $exception) {
            logger()->error($exception);
            return redirect('backend/dashboard')->with('error', Lang::get('messages.wrong'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'image' => 'required|mimes:png,jpeg,jpg,gif|max:10240', // 10mb
        ]);

        if ($validator->fails()) {
            return redirect('backend/image/create')
                ->withErrors($validator)
                ->withInput();
        }

        $image = $request->file('image');

        try {
            $s3 = Storage::disk('s3');
            $filePath = sprintf('/images/%s', sprintf('%s_%s', uniqid(), $image->getClientOriginalName()));
            $s3->put($filePath, file_get_contents($image), ['ACL' => 'public-read']);

            return redirect('backend/image')->with('success', Lang::get('messages.success'));
        } catch (\Exception $e) {
            logger()->error($e);
        }

        return redirect('backend/videos/create')->with('error', Lang::get('messages.wrong'));
    }

    public function removeImage(Request $request)
    {
        $name = $request->post('name');

        if ($name && Storage::disk('s3')->exists($name)) {
            Storage::disk('s3')->delete($name);
        }
    }
}
