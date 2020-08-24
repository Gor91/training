<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Courses;
use App\Models\Specialty;
use App\Services\CourseService;
use Illuminate\Support\Facades\Request;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

class CourseController extends Controller
{

    protected $service;


    public function __construct(CourseService $service)
    {
        $this->service = $service;
//        $this->user = JWTAuth::parseToken()->authenticate();
//        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    function getCourseBySpec(Request $request, $id)
    {
        try {

            $courses = $this->service->getCourses($id);
            return response()->json([
//                'access_token' => $request->token,
                'courses' => $courses,
//                'token_type' => 'bearer',
//                'expires_in' => auth('api')->factory()->getTTL() * 60
            ]);
        } catch (MethodNotAllowedHttpException$exception) {

            logger()->error($exception);
            return response()->json(['error' => true], 500);
        }
    }

    public function allCourses()
    {
        try {
            $courses = $this->service->all();
            return response()->json(['data' => $courses]);
        } catch (MethodNotAllowedHttpException$exception) {

            logger()->error($exception);
            return response()->json(['error' => true], 500);
        }
    }

    public function coursedetails(Request $request, $id)
    {
        $courses = Courses::where("id", '=', $id)->get();
        $coursespeciality = $courses[0]->specialty_ids;
        if (isset($courses)) {
            if ($courses[0]->specialty_ids) {
                $spec_ids = json_decode($courses[0]->specialty_ids);
                for ($i = 0; $i < count($spec_ids); $i++) {
                    $specialtis = Specialty::query()->find($spec_ids[$i]);
                    $specialties_obj[] = ["id" => $specialtis->id,
                        "name" => $specialtis->name];
                }
            }
            //$courses["specialities"] = $specialties_obj;
        }
//         var_dump($specialties_obj);
        return response()->json(['data' => $courses, 'specialities' => $specialties_obj]);
    }
}
