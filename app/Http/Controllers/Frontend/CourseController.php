<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\AccountVideo;
use App\Models\Book;
use App\Models\Courses;
use App\Models\Specialty;
use App\Models\Videos;
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
        $isFinished = true;
        $videos = Courses::select('videos')->where('id', request('id'))->first();
        if (!empty($videos->vidos)) {

            $videos = json_decode($videos->videos);
            foreach ($videos as $index => $video) {
                $status = AccountVideo::select('status')
                    ->where([["video_id", $video], ['account_id', request('user_id')]])
                    ->first();

                if ((!empty($status) && $status->status != "finished") || empty($status)) {
                    $isFinished = false;
                    break;
                }
            }
        }
        return $isFinished;
    }


}
