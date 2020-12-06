<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\AccountVideo;
use App\Models\Book;
use App\Models\Courses;
use App\Models\Specialty;
use App\Models\Videos;
use App\Services\CourseService;
use http\Exception\RuntimeException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;


class CourseAppController extends Controller
{

    protected $service;

    public function __construct(CourseService $service)
    {
        $this->service = $service;
//        $this->user = JWTAuth::parseToken()->authenticate();
//        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    function getCourseBySpec()
    {
        try {
            $courses = $this->service->getCourses(request('id'));

            return response()->json([
                'access_token' => request('token'),
                'courses' => $courses,
                'token_type' => 'bearer',
                'expires_in' => auth('api')->factory()->getTTL() * 60
            ]);
        } catch (MethodNotAllowedHttpException$exception) {

            logger()->error($exception);
            return response()->json(['error' => true], 500);
        }
    }

    function getCourseTitleById()
    {
        try {

            $title = $this->service->getCourseTitleById(request('id'));

            return response()->json([
                'access_token' => request('token'),
                'title' => $title,
                'token_type' => 'bearer',
                'expires_in' => auth('api')->factory()->getTTL() * 60
            ]);
        } catch (MethodNotAllowedHttpException$exception) {

            logger()->error($exception);
            return response()->json(['error' => true], 500);
        }
    }

    function getCourseInfo()
    {
        try {

            $courses = $this->service->getCoursesInfo(request('id'));

            return response()->json([
                'access_token' => request('token'),
                'courses' => $courses,
                'token_type' => 'bearer',
                'expires_in' => auth('api')->factory()->getTTL() * 60
            ]);
        } catch (MethodNotAllowedHttpException$exception) {

            logger()->error($exception);
            return response()->json(['error' => true], 500);
        }
    }

    function payment()
    {
        try {
            $form = request('form');
//            dd(base64_decode($form['number']));
            $data = [];
            $data['ClientID'] = '945431d0-ee02-4129-bacd-fc68eb0698ba';
            $data['Amount'] = 10;
            $data['OrderID'] = 2357310;
            $data["BackURL"]= "https://training.gtech.am/lesson";
            $data['Username'] = '3d19541048';
            $data['Password'] = 'lazY2k';
            $data['Description'] = $form['name'];
//            $data['Card number'] = '4083060010454680';
            $data['Cardholder'] = 'TEST CARD VPOS';
            $data['Currency'] = 'TEST Currency VPOS';
            $data['Opaque'] = 'TEST Opaque VPOS';
//            $data['Exp.date'] = '06/24';
//            $data['CVV'] = 281;
            //get data from db by course_id
//            $data['Amount'] = $form['cost'];

            //get course name bay course id
            try {
//
                $endpoint = "https://servicestest.ameriabank.am/VPOS/api/VPOS/InitPayment";
                $client = new \GuzzleHttp\Client();

                $response = $client->request('POST',
                    $endpoint, ['form_params' => $data]);
                $statusCode = $response->getStatusCode();
                $content = $response->getBody();
                $content = json_decode($response->getBody(), true);
                dd($content);
            } catch (RuntimeException $e) {
                dd($e);
            }



//            $courses = $this->service->getCoursesInfo(request('id'));
//
//            return response()->json([
//                'access_token' => request('token'),
//                'courses' => $courses,
//                'token_type' => 'bearer',
//                'expires_in' => auth('api')->factory()->getTTL() * 60
//            ]);
        } catch (MethodNotAllowedHttpException$exception) {

            logger()->error($exception);
            return response()->json(['error' => true], 500);
        }
    }

    function getBookById()
    {
        try {
            $book = $this->service->getBookById(request('id'));
            return response()->json([
                'access_token' => request('token'),
                'book' => $book,
                'token_type' => 'bearer',
                'expires_in' => auth('api')->factory()->getTTL() * 60
            ]);
        } catch (MethodNotAllowedHttpException$exception) {

            logger()->error($exception);
            return response()->json(['error' => true], 500);
        }
    }

    function getTestsById()
    {
        try {
            $tests = $this->service->getTestsById(request('id'), request('account_id'));

            return response()->json([
                'access_token' => request('token'),
                'tests' => $tests,
                'token_type' => 'bearer',
                'expires_in' => auth('api')->factory()->getTTL() * 60
            ]);
        } catch (MethodNotAllowedHttpException$exception) {

            logger()->error($exception);
            return response()->json(['error' => true], 500);
        }
    }


    public function coursedetails()
    {
        $courses = Courses::where("id", '=', request('id'))->first();

        if (isset($courses)) {
            if ($courses->books) {
                $books = json_decode($courses->books);

                $s3_books = [];
//                if (!$videos->isEmpty()) {
                foreach ($books as $index => $book) {
                    $b = Book::select('id', 'title')->where('id', $book)->first();

                    $s3_books[$index] = $b;
//                    $s3_books[$index]['path'] = sprintf("%s/%s", env('AWS_URL_ACL'), $b->path);
                }
                $courses->books = json_encode($s3_books, true);
            }
            if ($courses->videos) {
                $videos = json_decode($courses->videos);
                $s3_videos = [];
                if (!empty($videos)) {
                    foreach ($videos as $index => $video) {
                        $v = Videos::where('id', $video)->with('lectures')->first();
                        if (!empty($v)) {
                            $s3_videos[$index] = $v;
                            $s3_videos[$index]['path'] = sprintf("%s/%s", env('AWS_URL_ACL'), $v->path);
                        }
                    }
                    $courses->videos = json_encode($s3_videos, true);
                }
            }

            if (!empty($courses->credit)) {
                $credits = json_decode($courses->credit);

                $c = [];
                foreach ($credits as $index => $credit) {
                    $c[$index]['name'] = $credit->name;
                    $c[$index]['credit'] = $credit->credit;
                }

                $courses->credit = json_encode($c, true);
            }
            if ($courses->specialty_ids) {
                $spec_ids = json_decode($courses->specialty_ids);
                for ($i = 0; $i < count($spec_ids); $i++) {
                    $specialtis = Specialty::query()->find($spec_ids[$i]);
                    $specialties_obj[] = ["id" => $specialtis->id,
                        "name" => $specialtis->name];
                }
            }
            //$courses["specialities"] = $specialties_obj;
        }
        return response()->json(['data' => $courses, 'specialities' => $specialties_obj]);
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

    public function guard()
    {
        return \Auth::Guard('api');
    }
}
