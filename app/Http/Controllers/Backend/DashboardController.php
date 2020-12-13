<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Admin;
use App\Models\Courses;
use App\Models\Region;
use App\Repositories\Repository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    protected $model;


    public function __construct(Admin $admin)
    {
        // set the model
        $this->model = new Repository($admin);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $u_id = Session::get('u_id');
        $admin = $this->model->show($u_id);
        $data = Account::query()->select(['work_address', 'workplace_name'])->get();

        $workplace_region = [];

        if (!empty($data)) {
            $work_region_id = [];

            foreach ($data as $item) {
                $work_region_id[json_decode($item['work_address'])->w_region][] = $item['workplace_name'];
                $work_region_id[json_decode($item['work_address'])->w_region] = array_unique($work_region_id[json_decode($item['work_address'])->w_region]);
            }

            if (!empty($work_region_id)) {
                foreach ($work_region_id as $key => $val) {
                    $region_name = Region::query()->where(['id' => $key])->first('name');
                    $workplace_region[$key]['region'] = $region_name->name;

                    foreach ($val as $name) {
                        $workplace_region[$key]['workplace'][] = Account::query()->select(['workplace_name', DB::raw('count(workplace_name) as total')])
                            ->whereJsonContains('work_address->w_region', strval($key))
                            ->where(['workplace_name' => $name])->groupBy(['workplace_name'])->first()->toArray();
                    }
                }
            }
        }
    //        echo "<pre>";
    //        dd($workplace_region[7]['workplace']);
        $courses = Courses::query()->rightJoin('accounts_courses', 'accounts_courses.course_id', '=', 'courses.id')
            ->select('courses.name', 'accounts_courses.course_id', DB::raw('count(course_id) as total'), DB::raw('IF(`paid`,1,0) as isPaid'))
            ->groupBy(['course_id'])->get();

        return view('backend.dashboard', compact('admin', 'courses', 'workplace_region'));
    }
}
