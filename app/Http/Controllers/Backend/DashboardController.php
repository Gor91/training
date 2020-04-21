<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Repositories\Repository;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    protected $model;


    public function __construct(Admin $admin)
    {
        // set the model
        $this->model = new Repository($admin);
    }

    public function index()
    {
        $u_id = Session::get('u_id');
        $admin = $this->model->show($u_id);
        return view('backend.dashboard', compact('admin'));
    }
}
