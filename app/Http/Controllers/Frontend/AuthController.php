<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\AccountRequest;
use App\Http\Requests\ProfessionRequest;
use App\Http\Requests\UserRequest;
use App\Http\Traits\Registration;
use App\Models\Account;


/**
 * Class AuthController
 * @package App\Http\Controllers\Frontend
 */
class AuthController extends Controller
{

    use Registration;

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {

        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }


    /**
     * Get a JWT via given credentials.
     * @param AccountRequest $accountRequest
     * @param ProfessionRequest $professionRequest
     * @param UserRequest $userRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(AccountRequest $accountRequest,
                             ProfessionRequest $professionRequest,
                             UserRequest $userRequest)
    {
        return Registration::register($accountRequest, $professionRequest, $userRequest, 'user', 'pending');

    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $unverified = request(['email', 'password']);
        $credentials = request(['email', 'password']);
        $credentials['status'] = 'approved';
        try {
//          dd(JWTAuth::attempt($credentials));
            if (!$token = auth('api')->attempt($unverified)) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
            if (!$token = auth('api')->attempt($credentials)) {
                return response()->json(['error' => 'Unverified'], 400);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unauthorized'], 500);
        }
        return $this->respondWithTokenById($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        var_dump(response()->json(auth('api')->user()));
        return response()->json(auth('api')->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth('api')->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithTokenById(auth('api')->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        $user = $this->guard()->user();

        $account = Account::select(['id', 'name', 'surname', 'father_name', 'image_name'])
            ->with([
                'user' => function ($query) {
                    $query->select(['account_id', 'email']);
                },
                'prof' => function ($query) {
                    $query->select(['account_id', 'member_of_palace']);
                }
            ])->where('id', $user->account_id)
            ->first();

        return response()->json([
            'access_token' => $token,
            'user' => $account,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }

    /**
     * @param $token
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithTokenById($token)
    {
        $user = $this->guard()->user();
        $account = Account::select('id')
            ->where('id', $user->id)
            ->first();

        return response()->json([
            'access_token' => $token,
            'user' => $account,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 6000
        ]);
    }


    /**
     * @return mixed
     */
    public function guard()
    {
        return \Auth::Guard('api');
    }
}
