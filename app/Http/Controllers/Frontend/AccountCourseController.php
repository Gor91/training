<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\AccountVideoRequest;
use App\Services\AccountCourseService;
use App\Services\AccountVideoService;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AccountCourseController extends Controller
{
    protected $service;

    public function __construct(AccountCourseService $service)
    {
        $this->service = $service;
        $this->user = JWTAuth::parseToken()->authenticate();
//        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    function getResult()
    {
        try {
            $percent = $this->service->getTestResult(request('id'), request('user_id'), request('model'));
            return response()->json([
                'access_token' => request('token'),
                'percent' => $percent,
                'token_type' => 'bearer',
                'expires_in' => auth('api')->factory()->getTTL() * 60
            ]);
        } catch (MethodNotAllowedHttpException$exception) {

            logger()->error($exception);
            return response()->json(['error' => true], 500);
        }
    }
    function getTestsResult()
    {
        try {
            $tests = $this->service->getTestsResult(request('id') );

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

    function getCPCourse()
    {
        try {
            $info = $this->service->getCountOfTest(request('id'), request('user_id'));

            return response()->json([
                'access_token' => request('token'),
                'info' => json_encode($info),
                'token_type' => 'bearer',
                'expires_in' => auth('api')->factory()->getTTL() * 60
            ]);
        } catch (MethodNotAllowedHttpException$exception) {

            logger()->error($exception);
            return response()->json(['error' => true], 500);
        }
    }
}
