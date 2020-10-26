<?php


namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Courses;
use App\Models\Tests;
use App\Repositories\Repository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;

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
        $this->middleware('auth:admin');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function index()
    {
        try {
            $tests = Tests::query()->with('courses')->get();

            return view('backend.tests.index', compact('tests'));
        } catch (\Exception $exception) {

            return redirect('backend/test')->with('error', Lang::get('messages.wrong'));
        }
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function create()
    {
        try {
            $courses = new Courses();
            return view('backend.tests.create', compact('courses'));
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
        $input = $request->all();
        $answer_check = $validation_message = [];

        if (!empty($input['fields'])) {
            $is_valid = false;

            foreach ($input['fields'] as $question) {
                if (array_key_exists('check', $question)) {
                    $is_valid = true;
                    break;
                };
            }

            if (!$is_valid) {
                $answer_check = [
                    'fields.0.check' => 'required'
                ];

                $validation_message = [
                    'fields.0.check.required' => __('validation.answers.check')
                ];
            }
        }

        $validator = Validator::make($input, array_merge([
            'course_id' => 'required|exists:courses,id',
            'question' => 'required|string|min:2|max:190',
            'fields' => 'required|array|min:2',
            'fields.*.inp' => 'required|distinct'
        ], $answer_check), array_merge([
            'fields.min' => __('validation.answers.min'),
        ], $validation_message));

        if ($validator->fails()) {
            return redirect('backend/test/create')
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $data = [];
            $data['courses_id'] = $request->course_id;
            $data['question'] = $request->question;
            $data['answers'] = json_encode($request->fields);
            $this->model->create($data);
            return redirect('backend/test')->with('success', Lang::get('messages.success'));
        } catch (\Exception $exception) {
            logger()->error($exception);
            return redirect('backend/test')->with('error', Lang::get('messages.wrong'));
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
   public function destroy($id)
    {
        try {
            $this->model->delete($id);
            return redirect('backend/test')->with('success', Lang::get('messages.course_detete'));
        } catch (\Exception $exception) {
            logger()->error($exception);

            return redirect('backend/test')->with('error', Lang::get('messages.wrong'));
        }
    }

    /**
     * @param Tests $test
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Tests $test)
    {
        $courses = new Courses();
        return view('backend.tests.create', compact('test', 'courses'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $answer_check = $validation_message = [];

        if (!empty($input['fields'])) {
            $is_valid = false;

            foreach ($input['fields'] as $question) {
                if (array_key_exists('check', $question)) {
                    $is_valid = true;
                    break;
                };
            }

            if (!$is_valid) {
                $answer_check = [
                    'fields.0.check' => 'required'
                ];

                $validation_message = [
                    'fields.0.check.required' => __('validation.answers.check')
                ];
            }
        }

        $validator = Validator::make($input, array_merge([
            'course_id' => 'required|exists:courses,id',
            'question' => 'required|string|min:2|max:190',
            'fields' => 'required|array|min:2',
            'fields.*.inp' => 'required|distinct'
        ], $answer_check), array_merge([
            'fields.min' => __('validation.answers.min'),
        ], $validation_message));

        if ($validator->fails()) {
            return redirect(sprintf('backend/test/%d/edit', $id))
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $data = [];
            $data['courses_id'] = $request->course_id;
            $data['question'] = $request->question;
            $data['answers'] = json_encode($request->fields);
            $this->model->update($data, $id);
            return redirect('backend/test')->with('success', Lang::get('messages.success'));
        } catch (\Exception $exception) {
            logger()->error($exception);
            return redirect('backend/test')->with('error', Lang::get('messages.wrong'));
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
