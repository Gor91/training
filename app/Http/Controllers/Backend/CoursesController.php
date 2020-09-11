<?php


namespace App\Http\Controllers\Backend;

use App\Exports\CourseExport;
use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Courses;
use App\Models\CreditType;
use App\Models\Specialty;
use App\Models\Videos;
use App\Repositories\Repository;
use App\Services\GPDFService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class CoursesController extends Controller
{
    protected $model;
    protected $specialties;
    protected $fileNames;

    /**
     * CoursesController constructor.
     * @param Courses $courses
     */
    public function __construct(Courses $courses)
    {
        $this->model = new Repository($courses);
        $this->middleware('auth:admin');
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
            logger()->error($exception);
            return redirect('backend/courses')->with('error', Lang::get('messages.wrong'));
        }
    }

    /**
     * @param Request $request
     * @description function will be redirect to create page
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        try {
            $credit_types = CreditType::getCreditType();
            $videos = Videos::query()->select(['id', 'title'])->get();
            $books = Book::query()->select(['id', 'title'])->get();
            $speciality = new Specialty();

            return view('backend.courses.create', compact('credit_types', 'videos', 'books', 'speciality'));
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

        $validator = Validator::make($input, [
            'name' => 'required|min:2|max:190|string|unique:courses',
            'specialty_ids' => 'required|array|exists:specialties,id',
            'status' => 'required|in:"active","archive", "delete"',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            "duration" => "required|integer|gt:0",
            "credit" => "required|array|min:1",
            "credit.0.credit" => "required|integer|gt:0",
            "credit.*.credit" => "nullable|integer|gt:0",
            "cost" => "required|integer|gt:0|max:1000",
            "videos" => "nullable|array|exists:videos,id",
            "books" => "nullable|array|exists:books,id",
            "content_data" => "required|string|min:2|max:1000",
        ], [
            'name.unique' => __('messages.course_name_unique'),
        ]);

        if ($validator->fails()) {
            return redirect('backend/course/create')
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $cours = [];
            $cours['name'] = $request->name;
            $cours['specialty_ids'] = json_encode($request->specialty_ids);
            $cours['status'] = $request->status;
            $cours['start_date'] = date('Y-m-d', strtotime($request->start_date));
            $cours['end_date'] = date('Y-m-d', strtotime($request->end_date));
            $cours['duration'] = $request->duration;
            $cours['credit'] = json_encode($request->credit);
            $cours['videos'] = json_encode($request->videos);
            $cours['books'] = json_encode($request->books);
            $cours['cost'] = $request->cost;
            $cours['content'] = $request->content_data;
            $this->model->create($cours);
            return redirect('backend/course')->with('success', Lang::get('messages.success'));
        } catch (\Exception $exception) {
            logger()->error($exception);
            return redirect('backend/course')->with('error', Lang::get('messages.wrong'));
        }
    }

    /**
     * @param Courses $course
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function show(Courses $course)
    {
        try {
            if (!empty($course)) {
                $course["specialities"] = $course->getSpecialtyList();
                $course['video_list'] = $course->getVideoList();
                $course['book_list'] = $course->getBookList();
            }

            return view('backend.courses.show',
                compact('course'));
        } catch (ModelNotFoundException $exception) {
            logger()->error($exception);
            return redirect('backend/dashboard')->with('error', __('messages.wrong'));
        }
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    function update(Request $request, $id)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => sprintf('required|min:2|max:190|string|unique:courses,name,%d', $id),
            'specialty_ids' => 'required|array|exists:specialties,id',
            'status' => 'required|in:"active","archive", "delete"',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'duration' => 'required|integer|gt:0',
            "credit" => "required|array|min:1",
            "credit.0.credit" => "required|integer|gt:0",
            "credit.*.credit" => "nullable|integer|gt:0",
            "cost" => "required|integer|gt:0|max:1000",
            "videos" => "nullable|array|exists:videos,id",
            "books" => "nullable|array|exists:books,id",
            "content_data" => "required|string|min:2|max:1000",
        ], [
            'name.unique' => __('messages.course_name_unique'),
        ]);

        if ($validator->fails()) {
            return redirect(sprintf('backend/course/%d/edit', $id))
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $cours = [];
            $id = $request->id;
            $cours['name'] = $request->name;
            $cours['specialty_ids'] = json_encode($request->specialty_ids);
            $cours['status'] = $request->status;
            $cours['start_date'] = date('Y-m-d', strtotime($request->start_date));
            $cours['end_date'] = date('Y-m-d', strtotime($request->end_date));
            $cours['end_date'] = date('Y-m-d', strtotime($request->end_date));
            $cours['duration'] = $request->duration;
            $cours['credit'] = json_encode($request->credit);
            $cours['videos'] = json_encode($request->videos);
            $cours['books'] = json_encode($request->books);
            $cours['cost'] = $request->cost;
            $cours['content'] = $request->content_data;
            $this->model->update($cours, $id);
            return redirect('backend/course')->with('success', Lang::get('messages.updated'));
        } catch (\Exception $exception) {
            return redirect('backend/course')->with('error', Lang::get('messages.wrong'));
        }
    }

    /**
     * @param Courses $course
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    function destroy(Courses $course)
    {
        try {
            $course->delete();
            return redirect('backend/course')->with('success', Lang::get('messages.course_delete'));
        } catch (\Exception $exception) {
            logger()->error($exception);
            return redirect('backend/course')->with('error', Lang::get('messages.wrong'));
        }
    }

    /**
     * @param Courses $course
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function edit(Courses $course)
    {
        try {
            $videos = Videos::query()->select(['id', 'title'])->get();
            $books = Book::query()->select(['id', 'title'])->get();
            $credit_types = CreditType::getCreditType();
            $speciality = new Specialty();

            if (!empty($course)) {
                $course["specialities"] = $course->getSpecialtyList();
            }

            return view('backend.courses.create', compact('course', 'videos', 'books', 'credit_types', 'speciality'));
        } catch (\Exception $exception) {
            logger()->error($exception);
            return redirect('backend/course')->with('error', Lang::get('messages.wrong'));
        }
    }

    /**
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function gdPDF()
    {
        try {
            $data = $this->model;
            $path = sprintf('Courses_%s.pdf', date('d-m-Y'));
            $load_page = 'backend.courses.gd_pdf';
            $const = 'constants.TYPE_PATH';
            $pdf = GPDFService::gdPDF($path, $load_page, $const, $data);

            return response()->download($pdf);
        } catch (ModelNotFoundException $exception) {
            logger()->error($exception);
            return redirect('backend/course')->with('error', __('messages.wrong'));
        }

    }

    /**
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function gdExcel()
    {
        return Excel::download(new CourseExport(),
            sprintf('Courses_%s.xlsx', date('d-m-Y')));
    }
}
