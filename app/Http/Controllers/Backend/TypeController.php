<?php

namespace App\Http\Controllers\Backend;

use App\Exports\TypeExport;
use App\Http\Controllers\Controller;
use App\Services\GPDFService;
use App\Services\TypeService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class TypeController extends Controller
{

    private $service;

    /**
     * TypeController constructor.
     * @param TypeService $service
     */
    public function __construct(TypeService $service)
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
            $types = $this->service->getSpecialties();
            return view('backend.type.index',
                compact('types'));
        } catch (ModelNotFoundException $exception) {
            dd($exception);
            logger()->error($exception);
            return redirect('backend/type')->with('error', __('messages.wrong'));
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
            return view('backend.type.create');
        } catch (\Exception $exception) {
//            dd($exception);
            logger()->error($exception);
            return redirect('backend/type')->with('error', __('messages.wrong'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $this->service->store($request);
            return redirect('backend/type')->with('success', __('messages.success'));
        } catch (\Exception $exception) {
            dd($exception);
            logger()->error($exception);
            return redirect('backend/type')->with('error', __('messages.wrong'));
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
            $type = $this->service->show($id);

            return view('backend.type.show',
                compact('type'));
        } catch (ModelNotFoundException $exception) {
            dd($exception);
            logger()->error($exception);
            return redirect('backend/dashboard')->with('error', __('messages.wrong'));
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
            $type = $this->service->show($id);
            return view('backend.type.edit', compact('type'));
        } catch (\Exception $exception) {
            dd($exception);
            logger()->error($exception);
            return redirect('backend/type')->with('error', __('messages.wrong'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $this->service->update($request, $id);
            return redirect('backend/type')->with('success', __('messages.updated'));
        } catch (ModelNotFoundException $exception) {
            dd($exception);
            logger()->error($exception);
            return redirect('backend/type')->with('error', __('messages.wrong'));
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
        try {
            $this->service->destroy($id);

            return redirect('backend/type')->with('delete', __('messages.deleted'));
        } catch (ModelNotFoundException $exception) {
            logger()->error($exception);
            return redirect('backend/type')->with('error', __('messages.wrong'));
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function typeCheck(Request $request)
    {
        $response = [];
        try {

            if ($request->ajax()) {

                $i_id = $this->service->typeCheck($request);
                if ($i_id)
                    $response ['success'] = true;
            } else return redirect('backend/message')->with('error', __('messages.wrong'));
        } catch (ModelNotFoundException $exception) {
            logger()->error($exception);
            $response['success'] = false;
            $response['error'] = 'Do not save';

        }
        return response()->json($response);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function gdPDF()
    {
        try {
            $data = $this->service->getSpecialties();
            $path = 'types.pdf';
            $load_page = 'backend.type.gd_pdf';
            $const = 'constants.TYPE_PATH';
            $pdf = GPDFService::gdPDF($path, $load_page, $const, $data);

            return response()->download($pdf);
        } catch (ModelNotFoundException $exception) {
            logger()->error($exception);
            return redirect('backend/type')->with('error', __('messages.wrong'));
        }

    }

    /**
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function gdExcel()
    {
        return Excel::download(new TypeExport(),
            'types.xlsx');
    }

}
