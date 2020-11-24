<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\AccountVideo;
use App\Models\Courses;
use App\Services\CourseService;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;


class CourseController extends Controller
{

    protected $service;


    public function __construct(CourseService $service)
    {
        $this->service = $service;
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


    public function finishedCount()
    {
        $isFinished = 1;
        $videos = Courses::select('id','videos')
            ->with(['account_course' => function ($query) {
                $query->select('course_id')->where('course_id', request('id'));
            }])
            ->where('id', request('id'))
            ->first();

        if (!empty($videos->account_course)) {
            if (!empty($videos->videos)) {
                $videos = json_decode($videos->videos);
                if (!empty($videos)) {
                    foreach ($videos as $index => $video) {
                        $status = AccountVideo::select('status')
                            ->where([["video_id", $video], ['account_id', request('user_id')]])
                            ->first();

                        if ((!empty($status) && $status->status != "finished")
                            || empty($status)) {

                            $isFinished = 0;
                            break;
                        }
                    }
                }
            }
        } else
            $isFinished = -1;
        return $isFinished;
    }


}
