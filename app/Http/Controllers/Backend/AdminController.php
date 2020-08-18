<?php

namespace App\Http\Controllers\Backend;

use App\Exports\AdminExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminEditRequest;
use App\Http\Requests\AdminRequest;
use App\Http\Requests\PasswordRequest;
use App\Models\Admin;
use App\Repositories\Repository;
use App\Services\AdminService;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{
    // space that we can use the repository from
    protected $model;

    public function __construct(Admin $admin)
    {
        // set the model
        $this->middleware('auth:admin');
        $this->model = new Repository($admin);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $admins = $this->model->all();
            return view('backend.admin.index',
                compact('admins'));
        } catch (\Exception $exception) {
            dd($exception);
            logger()->error($exception);
            return redirect('backend/dashboard')->with('error', __('messages.wrong'));
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
            return view('backend.admin.create');
        } catch (\Exception $exception) {
            dd($exception);
            logger()->error($exception);
            return redirect('backend/dashboard')->with('error', __('messages.wrong'));
        }
    }


    /**
     * @param AdminRequest $request
     * @param AdminService $service
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(AdminRequest $request, AdminService $service)
    {
        try {
            $service->make($request);
            return redirect('backend/admin')->with('success', __('messages.success'));
        } catch (\Exception $exception) {
            dd($exception);
            logger()->error($exception);
            return redirect('backend/admin')->with('error', __('messages.wrong'));
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
            $data = $this->model->show($id);
            return view('backend.admin.show',
                compact('data'));
        } catch (\Exception $exception) {
//            dd($exception);
            logger()->error($exception);
            return redirect('backend/dashboard')->with('error', __('messages.wrong'));
        }
    }


    /**
     * Update the specified resource in storage.
     * @param AdminEditRequest $request
     * @param $id
     * @param AdminService $service
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(AdminEditRequest $request, $id, AdminService $service)
    {
        try {
            $service->update($request, $id);
            return redirect()->back()->with('success', __('messages.updated'));

        } catch (\Exception $e) {
            logger()->error($e);
            return redirect()->back()
                ->withErrors($e->getErrors())
                ->withInput();
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
            $this->model->delete($id);
            return redirect('backend/admin/index')->with('success', __('messages.success'));
        } catch (\Exception $e) {
            logger()->error($e);
            return redirect()->back()
                ->withErrors($e->getErrors())
                ->withInput();
        }
    }


    public function changePassword(PasswordRequest $request, $id, AdminService $service)
    {
        try {

            $admin = $this->model->show($id);
            if (!Hash::check($request->old_password, $admin->password)) {
                return back()
                    ->with('error', __('messages.db_password'));
            } else {
                $service->updatePassword($request, $id);
                return Redirect::to('backend/logout')->with('success', __('messages.updated'));
            }

        } catch (\Exception $exception) {
            logger()->error($exception);
            return redirect()->back()->with('error', __('messages.wrong'));
        }
    }

    public function gdPDF()
    {
        $data = $this->model->all();

        $title = __('messages.admin');
        $pdf = PDF::loadView('backend.admin.gd_pdf', ['data' => $data])->setPaper('a4', 'landscape')->setWarnings(false);
        // If you want to store the generated pdf to the server then you can use the store function
        if (!Storage::exists(Config::get('constants.ADMIN_PATH'))) {
            Storage::makeDirectory(Config::get('constants.ADMIN_PATH'), 0775, true);
        }

        $pdf->save(storage_path() . Config::get('constants.APP') . Config::get('constants.ADMIN_PATH') . 'admin.pdf');

        // Finally, you can download the file using download function
        return response()->download(storage_path(Config::get('constants.APP') . Config::get('constants.ADMIN_PATH') . 'admin.pdf'));
//        return $pdf->download($title.'.pdf');
    }

    public function gdExcel()
    {
        return Excel::download(new AdminExport(),
            'admins.xlsx');
    }
}
