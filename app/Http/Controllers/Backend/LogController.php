<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Email;
use App\Repositories\Repository;

class LogController extends Controller
{
    // space that we can use the repository from
    /**
     * @var Repository
     */
    protected $model;

    /**
     * LogController constructor.
     * @param Email $email
     */
    public function __construct(Email $email)
    {
        // set the model
        $this->model = new Repository($email);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $logs = $this->model->with([
                'admin' => function ($query) {
                    $query->select(['name', 'id']);
                },
                'account' => function ($query) {
                    $query->select(['id', 'name', 'surname', 'father_name']);
                }])->get();
//
//            dd($logs);
            return view('backend.log.index',
                compact('logs'));
        } catch (\Exception $exception) {
            dd($exception);
            logger()->error($exception);
            return redirect('backend/log')->with('error', __('messages.wrong'));
        }
    }


    /**
     * Display the specified resource.
     *
     * @param \App\Models\Email $email
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $log = $this->model->with([
            'admin' => function ($query) {
                $query->select(['name', 'id']);
            },
            'account' => function ($query) {
                $query->select(['id', 'name', 'surname', 'father_name']);
            }])
            ->where('id', $id)
            ->first();
//
//            dd($logs);
        return view('backend.log.show',
            compact('log'));
    }


}
