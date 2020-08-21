<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\AccountCourseRequest;
use App\Models\AccountCourse;
use App\Repositories\Repository;
use Illuminate\Support\Facades\Lang;

class CommentController extends Controller
{
    // space that we can use the repository from
    protected $model;

    public function __construct(AccountCourse $accountcourse)
    {
        // set the model
        $this->model = new Repository($accountcourse);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $comments = AccountCourse::all();
            return view('backend.comment.index',
                compact('comments'));
        } catch (\Exception $exception) {
            dd($exception);
            logger()->error($exception);
            return redirect('backend/comments')->with('error', Lang::get('messages.wrong'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(PageRequest $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $data = $this->model->show($id);//
            return view('backend.comment.show',
                compact('data'));
        } catch (\Exception $exception) {
            dd($exception);
            logger()->error($exception);
            return redirect('backend/message')->with('error', Lang::get('messages.wrong'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $comments = $this->model->show($id);
            $comments['panding'] = 'read';
            $this->model->update($comments, $id);

            return view('backend.message.edit', compact('$comments'));
        } catch (\Exception $exception) {
            dd($exception);
            logger()->error($exception);
            return redirect('backend/message')->with('error', Lang::get('messages.wrong'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(PageRequest $request, $id)
    {

        try {
            $comments = $this->model->show($id);
            $comments['panding'] = 'read';
            $this->model->update($comments, $id);
            return redirect('backend/comments')->with('success', Lang::get('messages.success'));
        } catch (\Exception $exception) {

            logger()->error($exception);
            return redirect('backend/pages')->with('error', Lang::get('messages.wrong'));
        }
    }
    public function commentstatus(AccountCourseRequest $request)
    {

        try {
            $comments[] = $this->model->show($request->id);
            $comments['panding'] = 'read';
            $this->model->update($comments, $request->id);
            return redirect('backend/comments')->with('success', Lang::get('messages.success'));
        } catch (\Exception $exception) {

            logger()->error($exception);
            return redirect('backend/comments')->with('error', Lang::get('messages.wrong'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
