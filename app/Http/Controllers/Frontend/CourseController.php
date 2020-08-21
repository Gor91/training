<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Services\CourseService;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class CourseController extends Controller
{

    protected $service;


    public function __construct(CourseService $service)
    {
        $this->service = $service;
//        $this->user = JWTAuth::parseToken()->authenticate();
//        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    function getCourseBySpec($id)
    {
        $this->service->getCourses($id);
    }
}
