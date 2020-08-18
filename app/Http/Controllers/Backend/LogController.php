<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Services\LogService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;

/**
 * Class LogController
 * @package App\Http\Controllers\Backend
 */
class LogController extends Controller
{

    /**
     * @var Log
     */
    private $service;


    /**
     * LogController constructor.
     * @param LogService $service
     */
    public function __construct(LogService $service)
    {
        $this->middleware('auth:admin');
        // set the service
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {

            $logs = $this->service->all();
            return view('backend.log.index',
                compact('logs'));
        } catch (ModelNotFoundException $exception) {
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
        try {
            $log = $this->service->show($id);
            return view('backend.log.show',
                compact('log'));
        } catch (ModelNotFoundException $exception) {

            logger()->error($exception);
            return redirect('backend/log')->with('error', __('messages.wrong'));
        }
    }


}
