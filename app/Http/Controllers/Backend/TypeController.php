<?php

namespace App\Http\Controllers\Backend;

use App\Exports\TypeExport;
use App\Http\Controllers\Controller;
use App\Models\Specialties;
use App\Models\SpecialtiesType;
use App\Repositories\Repository;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class TypeController extends Controller
{
    // space that we can use the repository from
    protected $model;

    public function __construct(SpecialtiesType $type)
    {
        // set the model
        $this->model = new Repository($type);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $types = $this->model->all();
            return view('backend.type.index',
                compact('types'));
        } catch (\Exception $exception) {
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
            dd($exception);
            logger()->error($exception);
            return redirect('backend/type')->with('error', __('messages.wrong'));
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
        try {
            $data = [];
            $data['name'] = $request->name;
            $data['icon'] = $request->icon;
            $data['description'] = $request->description;
            $this->model->create($data);
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
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $type = $this->model->show($id);
//            dd($type);
            return view('backend.type.show',
                compact('type'));
        } catch (\Exception $exception) {
            dd($exception);
            logger()->error($exception);
            return redirect('backend/dashboard')->with('error', __('messages.wrong'));
        }
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
            $type = $this->model->show($id);

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
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $data['name'] = $request->name;
            $data['icon'] = $request->icon;
            $data['description'] = $request->description;

            $this->model->update($data, $id);
            return redirect('backend/type')->with('success', __('messages.success'));
        } catch (\Exception $exception) {
            dd($exception);
            logger()->error($exception);
            return redirect('backend/type')->with('error', __('messages.wrong'));
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
        try {
            $this->model->delete($id);
            return redirect('backend/type')->with('delete', 'deleted');
        } catch (\Exception $exception) {
            logger()->error($exception);
            return redirect('backend/type')->with('error', __('messages.wrong'));
        }
    }

    public function typeCheck(Request $request)
    {
        $ug = Specialties::where('type_id', $request->id)->first();

        if (!empty($ug))
            $response = [
                'success' => true
            ];
        else
            $response = [
                'success' => false,
                'error' => 'Do not save'
            ];
        return response()->json($response);

    }

    public function gdPDF()
    {
        $data = $this->model->all();

        $title = __('messages.type');
        $pdf = PDF::loadView('backend.type.gd_pdf', ['data' => $data])->setPaper('a4', 'landscape')->setWarnings(false);
        // If you want to store the generated pdf to the server then you can use the store function
        if (!Storage::exists(Config::get('constants.TYPE_PATH'))) {
            Storage::makeDirectory(Config::get('constants.TYPE_PATH'), 0775, true);
        }

        $pdf->save(storage_path() . Config::get('constants.APP') . Config::get('constants.TYPE_PATH') . 'type.pdf');

        // Finally, you can download the file using download function
        return response()->download(storage_path(Config::get('constants.APP') . Config::get('constants.TYPE_PATH') . 'type.pdf'));
//        return $pdf->download($title.'.pdf');
    }

    public function gdExcel()
    {
        return Excel::download(new TypeExport(),
            'types.xlsx');
    }

}
