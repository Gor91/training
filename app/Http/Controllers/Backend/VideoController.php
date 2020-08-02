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

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videos = Videos::query()->with('lectures')->get();

        return view('backend.video.index', compact('videos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            $lectures = Account::query()->where(['role' => 'lecture'])->get()->toArray();

            return view('backend.video.create', compact('lectures'));
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

        $validator = Validator::make($input, Videos::rules());

        if ($validator->fails()) {
            return redirect('backend/videos/create')
                ->withErrors($validator)
                ->withInput();
        }

        $model = new Videos();
        $model->title = $input['title'];
        $model->path = $input['path'];
        $model->duration = isset($input['duration']) ? $input['duration'] : null;
        $model->lectures_id = $input['lecture'];

        try {
            if ($model->save()) {
                return redirect('backend/videos/create')->with('success', Lang::get('messages.success'));
            }
        } catch (\Exception $e) {
            logger()->error($e);
        }

        return redirect('backend/videos/create')->with('error', Lang::get('messages.wrong'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $lectures = Account::query()->where(['role' => 'lecture'])->get()->toArray();
            $model = Videos::query()->where(['id' => $id]);

            if ($model->exists()) {
                $video = $model->first();
                return view('backend.video.edit', compact('lectures', 'video'));
            }
        } catch (\Exception $exception) {
            logger()->error($exception);
        }

        return redirect('backend/dashboard')->with('error', Lang::get('messages.wrong'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $video = Videos::query()->where(['id' => $id]);

        if ($video->exists()) {
            $model = $video->first();
        } else {
            throw new NotFoundHttpException();
        }

        $input = $request->all();

        $validator = Validator::make($input, [
            'title' => 'required|string|min:2|max:190|unique:videos,title,' . $id,
            'path' => 'sometimes|nullable|string|min:2|max:190|unique:videos,path,' . $id,
            'video' => 'sometimes|mimes:mp4',
            'duration' => 'sometimes|nullable|numeric',
            'lecture' => 'required|exists:accounts,id',
        ], [
            'title.unique' => __('messages.title_unique'),
            'path.path' => __('messages.path_unique')
        ]);

        if ($validator->fails()) {
            return redirect(sprintf('backend/videos/%s/edit', $id))
                ->withErrors($validator)
                ->withInput();
        }

        $old_path = $model->path;

        $is_path_changed = false;

        if ($input['path'] && $input['path'] != $old_path) {
            $model->path = $input['path'];
            $is_path_changed = true;
        }

        $model->title = $input['title'];
        $model->duration = isset($input['duration']) ? $input['duration'] : null;
        $model->lectures_id = $input['lecture'];

        try {
            if ($model->save()) {
                if ($is_path_changed && Storage::disk('s3')->exists($old_path)) {
                    Storage::disk('s3')->delete($old_path);
                }

                return redirect('backend/videos')->with('success', Lang::get('messages.updated'));
            }
        } catch (\Exception $e) {
            logger()->error($e);
        }

        return redirect('backend/videos')->with('error', Lang::get('messages.wrong'));
    }

    public function removeVideo(Request $request)
    {
        $name = $request->post('name');

        if ($name && Storage::disk('s3')->exists($name)) {
            Storage::disk('s3')->delete($name);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
