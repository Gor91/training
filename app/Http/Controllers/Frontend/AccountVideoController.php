<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Services\AccountVideoService;
use Illuminate\Support\Facades\Request;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AccountVideoController extends Controller
{
    protected $service;

    public function __construct(AccountVideoService $service)
    {
        $this->service = $service;
        $this->user = JWTAuth::parseToken()->authenticate();
//        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function getVideoById(Request $request, $id)
    {
        try {

            $video = $this->service->getVideoById($request,$id);
            return response()->json([
                'access_token' => $request->token,
                'video' => $video[0],
//                'token_type' => 'bearer',
//                'expires_in' => auth('api')->factory()->getTTL() * 60
            ]);
        } catch (MethodNotAllowedHttpException$exception) {

            logger()->error($exception);
            return response()->json(['error' => true], 500);
        }
    }
}
