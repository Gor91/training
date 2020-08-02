<?php


namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Courses;
use App\Models\Tests;
use App\Repositories\Repository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class TestsController extends Controller
{
    protected $model;

    /**
     * TestsController constructor.
     * @param Tests $tests
     */
    public function __construct(Tests $tests)
    {
        $this->model = new Repository($tests);
    }

    public function index()
    {
        try {
            $tests = Tests::query()->with('courses')->get();

            return view('backend.tests.index', compact('tests'));
        } catch (\Exception $exception) {

            return redirect('backend/tests')->with('error', Lang::get('messages.wrong'));
        }
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function create()
    {
        try {
            return view('backend.tests.create');
        } catch (\Exception $exception) {
            logger()->error($exception);
            return redirect('backend/dashboard')->with('error', Lang::get('messages.wrong'));
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'question' => 'required',
            'courses' => 'required'
        ]);
        try {
            $data = [];
            $data['courses_id'] = $request->courses;
            $data['question'] = $request->question;
            $data['answers'] = json_encode($request->fields);
            $this->model->create($data);
            return redirect('backend/tests')->with('success', Lang::get('messages.success'));
        } catch (\Exception $exception) {
            logger()->error($exception);
            dd($exception);
            return redirect('backend/tests')->with('error', Lang::get('messages.wrong'));
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    function destroy($id)
    {
        try {
            $this->model->delete($id);
            return redirect('backend/tests')->with('success', Lang::get('messages.course_detete'));
        } catch (\Exception $exception) {
            logger()->error($exception);

            return redirect('backend/tests')->with('error', Lang::get('messages.wrong'));
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function editTests(Request $request)
    {
        if (isset($request->courses)) {
            $validate = $request->validate([
                'question' => 'required',
                'courses' => 'required'
            ]);
            $data = [];
            $data['courses_id'] = $request->courses;
            $data['question'] = $request->question;
            $data['answers'] = json_encode($request->fields);
            try {
                $this->model->update($data, $request->id);

                return redirect('backend/tests')->with('success', Lang::get('messages.success'));
            } catch (\Exception $exception) {
                logger()->error($exception);

                return redirect('backend/tests')->with('error', Lang::get('messages.wrong'));
            }
        } else {
            try {
                $test = Tests::query()->where(["id" => $request->id])->with('courses')->first();
                if (isset($test)) {

                    return view('backend.tests.create', compact('test'));
                }
            } catch (\Exception $exception) {
                logger()->error($exception);

                return redirect('backend/tests')->with('error', Lang::get('messages.wrong'));
            }
        }

    }

    /**
     * @param Request $request
     * @return false|string
     */
    public function getCourses(Request $request)
    {
        if ($request->term) {
            $data = Courses::query()->where('name', 'LIKE', '%' . $request->term . '%')->get();
            $tmp = [];
            for ($i = 0; $i < count($data); $i++) {
                $tmp[$data[$i]->special_type_name][] = ['text' => $data[$i]->name, 'id' => $data[$i]->id];
            }

            return json_encode($tmp);
        } else {
            $data = Courses::all();
            $tmp = [];
            for ($i = 0; $i < count($data); $i++) {
                $tmp[$data[$i]->special_type_name][] = ['text' => $data[$i]->name, 'id' => $data[$i]->id];
            }

            return json_encode($tmp);
        }
    }
}
