<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MessageRequest;
use App\Services\MessageService;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class MessageController extends Controller
{

    private $service;

    public function __construct(MessageService $service)
    {
        // set the service
        $this->service = $service;
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $messages = $this->service->all();

            return view('backend.message.index',
                compact('messages'));
        } catch (ModelNotFoundException $exception) {
            logger()->error($exception);
            return redirect('backend/message')->with('error', __('messages.wrong'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            return view('backend.message.create');
        } catch (\Exception $exception) {
            logger()->error($exception);
            return redirect('backend/message')->with('error', __('messages.wrong'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(MessageRequest $request)
    {
        try {
            $this->service->store($request);
            return redirect('backend/message')->with('success', __('messages.success'));
        } catch (\Exception $exception) {
            logger()->error($exception);
            return redirect('backend/message')->with('error', __('messages.wrong'));
        }
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
            $data = $this->service->show($id);//
            return view('backend.message.show',
                compact('data'));
        } catch (\Exception $exception) {
            dd($exception);
            logger()->error($exception);
            return redirect('backend/message')->with('error', __('messages.wrong'));
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
            $message =  $this->service->show($id);

            return view('backend.message.edit', compact('message'));
        } catch (\Exception $exception) {
            dd($exception);
            logger()->error($exception);
            return redirect('backend/message')->with('error', __('messages.wrong'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(MessageRequest $request, $id)
    {
        try {

            $this->service->update($request, $id);

            return redirect('backend/message')->with('success', __('messages.updated'));
        } catch (ModelNotFoundException $exception) {

            logger()->error($exception);
            return redirect('backend/message')->with('error', __('messages.wrong'));
        }
    }


}
