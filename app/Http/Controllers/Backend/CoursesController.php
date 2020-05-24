<?php


namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Courses;
use App\Repositories\Repository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;

class CoursesController extends Controller
{
    protected $model;
    protected $fileNames;

    public function __construct(Courses $courses)
    {
        $this->model = new Repository($courses);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function index()
    {
        try {
            $courses = $this->model->all();
            return view('backend.courses.index', compact('courses'));
        } catch (\Exception $exception) {
            dd($exception);
            logger()->error($exception);
            return redirect('backend/courses')->with('error', Lang::get('messages.wrong'));
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {
            $cours = [];
            $cours['name'] = $request->name;
            $cours['specialty_ids'] = json_encode($request->specialty_ids);
            $cours['status'] = $request->status;
            $cours['duration_date'] = $request->date;
            $cours['credit'] = $request->credit;
            $cours['content'] = $request->content_data;
            $this->model->create($cours);
            return redirect('backend/courses')->with('success', Lang::get('messages.success'));
        } catch (\Exception $exception) {
            dd($exception);
            logger()->error($exception);
            return redirect('backend/courses')->with('error', Lang::get('messages.wrong'));
        }
    }

    /**
     * @param Request $request
     */
    public function fileUpload(Request $request)
    {
        //will be implemented

    }

    /**
     * @param Request $request
     */
    public function editCourses(Request $request)
    {
        //will be implemented
    }

    /**
     * @param Request $request
     * @return false|string
     */
    public function getSpecialities(Request $request)
    {
        $data = DB::table('specialties')
            ->join('specialties_types', 'specialties.type_id', '=', 'specialties_types.id')
            ->select('specialties_types.name as  special_type_name', 'specialties.id',
                'specialties.name')->get();
        $tmp = [];
        for ($i = 0; $i < count($data); $i++){
            $tmp[$data[$i]->special_type_name][] = ['text'=>$data[$i]->name, 'id'=>$data[$i]->id];
        }

        return json_encode($tmp);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        try {
            return view('backend.courses.create');
        } catch (\Exception $exception) {
            dd($exception);
            logger()->error($exception);
            return redirect('backend/dashboard')->with('error', Lang::get('messages.wrong'));
        }
    }
}
