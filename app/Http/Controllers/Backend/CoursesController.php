<?php


namespace App\Http\Controllers\Backend;

use App\Exports\CourseExport;
use App\Http\Controllers\Controller;
use App\Models\AccountCourse;
use App\Models\Book;
use App\Models\Courses;
use App\Models\CreditType;
use App\Models\SpecialtiesType;
use App\Models\Specialty;
use App\Models\Videos;
use App\Repositories\Repository;
use App\Services\GPDFService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
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
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function result(Request $request)
    {
        $time = $request->get('time');
        $paid = $request->get('paid');

        if ($time) {
            $model = AccountCourse::query()->select('count', DB::raw('count(*) as total'))->groupBy(['count'])->orderBy('count');
        } elseif ($paid) {
            $model = AccountCourse::query()->select('paid', DB::raw('count(*) as total'))->groupBy(['paid'])->orderBy('paid');
        } else {
            $model = AccountCourse::query()->select('status', DB::raw('count(*) as total'))->groupBy(['status']);
        }

        return response()->json($model->get());
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function resultSpeciality(Request $request)
    {
        $specialty_curse_list = [];
        $model = Courses::query()->select('specialty_ids');
        $data = $model->get();

        if (!empty($data)) {
            foreach ($data as $item) {
                $specialty_curse_list[] = json_decode($item['specialty_ids']);
            }
        }

        $array = Arr::collapse($specialty_curse_list);
        $count_values = array_count_values($array);

        $spec = Specialty::query()->select(['id', 'type_id'])->whereIn('id', $array)->get();
        $collection = collect($spec);

        $grouped = $collection->mapToGroups(function ($item, $key) {
            return [$item['type_id'] => $item['id']];
        });

        $grouped_specialty = $grouped->all();
        $course_list = [];

        if (!empty($grouped_specialty)) {
            if (!empty($grouped_specialty[SpecialtiesType::DOCTOR])) {
                $course_doctor = array_map(function ($v) {
                    return strval($v);
                }, $grouped_specialty[SpecialtiesType::DOCTOR]->toArray());

                $course_list[] = ['Բժիշկ', array_sum(array_values(Arr::only($count_values, $course_doctor))), 'green'];
            }

            if (!empty($grouped_specialty[SpecialtiesType::NURSE])) {
                $course_nurse = array_map(function ($v) {
                    return strval($v);
                }, $grouped_specialty[SpecialtiesType::NURSE]->toArray());

                $course_list[] = ['Բուժքույր', array_sum(array_values(Arr::only($count_values, $course_nurse))), 'blue'];
            }

            if (!empty($grouped_specialty[SpecialtiesType::PHARMACIST])) {
                $course_pharmacist = array_map(function ($v) {
                    return strval($v);
                }, $grouped_specialty[SpecialtiesType::PHARMACIST]->toArray());

                $course_list[] = ['Դեղագետ', array_sum(array_values(Arr::only($count_values, $course_pharmacist))), 'silver'];
            }

            if (!empty($grouped_specialty[SpecialtiesType::DISPENSER])) {
                $course_dispenser = array_map(function ($v) {
                    return strval($v);
                }, $grouped_specialty[SpecialtiesType::DISPENSER]->toArray());

                $course_list[] = ['Դեղագործ', array_sum(array_values(Arr::only($count_values, $course_dispenser))), 'color: #2abe81'];
            }
        }

        return response()->json($course_list);
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
            dd($exception);
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
            "certificate" => "nullable|file|mimes:jpg,jpeg,png",
            "coord.name" => "nullable|string",
            "coord.start_date" => "nullable|string",
            "coord.end_date" => "nullable|string",
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
            $file = $request->file('certificate');

            if (!empty($file)) {
                $cert_name = sprintf('%s.jpg', $request->name);
                $path = public_path(Config::get('constants.UPLOADS') . '/diplomas');
                $file->move($path, $cert_name);

                $get_coord = $request->coord;

                list($name_x, $name_y) = explode(',', $get_coord['name']);
                list($start_date_x, $start_date_y) = explode(',', $get_coord['start_date']);
                list($end_date_x, $end_date_y) = explode(',', $get_coord['end_date']);

                $coord = [
                    'name' => [
                        'x' => $name_x,
                        'y' => $name_y
                    ],
                    'start_date' => [
                        'x' => $start_date_x,
                        'y' => $start_date_y
                    ],
                    'end_date' => [
                        'x' => $end_date_x,
                        'y' => $end_date_y
                    ]
                ];

                $cours['certificate'] = $cert_name;
                $cours['coordinates'] = json_encode($coord);
            }

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
            "certificate" => "nullable|file|mimes:jpg,jpeg,png",
            "coord.name" => "nullable|string",
            "coord.start_date" => "nullable|string",
            "coord.end_date" => "nullable|string",
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
            $file = $request->file('certificate');
            $model = Courses::query()->find($id);

            if (!empty($file) || !empty($model->certificate)) {
                if (!empty($file)) {
                    $cert_name = sprintf('%s.jpg', $request->name);
                    $path = public_path(Config::get('constants.UPLOADS') . '/diplomas');
                    $file->move($path, $cert_name);
                    $cours['certificate'] = $cert_name;
                }

                $get_coord = $request->coord;

                list($name_x, $name_y) = explode(',', $get_coord['name']);
                list($start_date_x, $start_date_y) = explode(',', $get_coord['start_date']);
                list($end_date_x, $end_date_y) = explode(',', $get_coord['end_date']);

                $coord = [
                    'name' => [
                        'x' => $name_x,
                        'y' => $name_y
                    ],
                    'start_date' => [
                        'x' => $start_date_x,
                        'y' => $start_date_y
                    ],
                    'end_date' => [
                        'x' => $end_date_x,
                        'y' => $end_date_y
                    ]
                ];

                $cours['coordinates'] = json_encode($coord);
            }

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
