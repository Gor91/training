<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\SpecialtiesType;
use App\Models\Specialty;
use App\Repositories\Repository;
use Illuminate\Http\Request;

class SpecialtyController extends Controller
{
    // space that we can use the repository from
    protected $model;

    public function __construct(Specialty $specialty)
    {
        // set the model
        $this->model = new Repository($specialty);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $specs = $this->model->with([
                'specialty' => function ($query) {
                    $query->select(['id', 'parent_id', 'type_id', 'name']);

                },
                'specialty.type' => function ($query) {
                    $query->select(['id', 'name']);

                }])->whereNull('parent_id')->get();

            return view('backend.specialty.index',
                compact('specs'));
        } catch (\Exception $exception) {
            dd($exception);
            logger()->error($exception);
            return redirect('backend/specialty')->with('error', __('specialtys.wrong'));
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
            $sections = $this->model->whereNull('parent_id', ['name', 'id']);
            $types = SpecialtiesType::pluck('name', 'id');

            return view('backend.specialty.create', compact('types'));
        } catch (\Exception $exception) {
            dd($exception);
            logger()->error($exception);
            return redirect('backend/specialty')->with('error', __('messages.wrong'));
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
            $data = [];
            $data['type_id'] = $request->type_id;
            $data['parent_id'] = $request->parent_id;
            $data['name'] = $request->name;
            $data['icon'] = $request->icon;
            $this->model->create($data);
            return redirect('backend/specialty')->with('success', __('messages.success'));
        } catch (\Exception $exception) {
            dd($exception);
            logger()->error($exception);
            return redirect('backend/specialty')->with('error', __('messages.wrong'));
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
            $specs = $this->model->with([
                'specialty' => function ($query) {
                    $query->select(['id', 'parent_id', 'type_id', 'name']);
                },
                'specialty.type' => function ($query) {
                    $query->select(['id', 'name']);
                }])
                ->where('id', $id)->get();

            return view('backend.specialty.list',
                compact('specs'));
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
        //
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
        //
    }

    public function updateSpecialty(Request $request)
    {
        try {
            $data['name'] = $request->name;
            $this->model->update($data, $request->id);
            $response = [
                'success' => true
            ];
        } catch (\Exception $exception) {

            logger()->error($exception);
            $response = [
                'success' => false,
                'error' => 'Do not save'
            ];
        }
        return response()->json($response);
    }

    public function checkSpecialty(Request $request)
    {
        try {
            dd($request->id);
            //todo get courses ids
            $response = [
                'success' => true
            ];
        } catch (\Exception $exception) {

            logger()->error($exception);
            $response = [
                'success' => false,
                'error' => 'Do not save'
            ];
        }
        return response()->json($response);
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
