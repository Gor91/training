<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\AccountApproveRequest;
use App\Http\Requests\AccountEditRequest;
use App\Http\Requests\AvatarRequest;
use App\Http\Requests\PasswordRequest;
use App\Http\Requests\ProfessionApproveRequest;
use App\Http\Requests\ProfessionEditRequest;
use App\Http\Requests\UserEditRequest;
use App\Models\Account;
use App\Models\User;
use App\Repositories\Repository;
use App\Services\AccountService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Tymon\JWTAuth\Facades\JWTAuth;


class AccountController extends Controller
{
    /**
     * @var Repository
     */
    protected $service;

    /**
     * Create a new AccountController instance.
     *
     * @return void
     */
    public function __construct(AccountService $service)
    {
        $this->service = $service;
        $this->user = JWTAuth::parseToken()->authenticate();
//        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            dd($_GET);
        } catch (\Exception $exception) {
            dd($exception);
            logger()->error($exception);
//            return redirect('backend/dashboard')->with('error', Lang::get('messages.wrong'));
        }
    }


    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function editProfile(Request $request, $id)
    {
        $profile = $this->service->getFAccountById($id);
        $approve = $this->service->getFAccount($id);
        return response()->json([
            'access_token' => $request->token,
            'user' => $profile,
            'app' => $approve,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }

    /**
     * @param AvatarRequest $request
     * @param AccountService $service
     * @return \Illuminate\Http\JsonResponse
     */
    public function avatar(AvatarRequest $request)
    {
//todo test
        $result = $this->service->updateFAvatar($request);
        if ($result)
            return $this->respondWithToken($request->token);
        return response()->json(['error' => true], 500);

    }

    /**
     * @param AccountEditRequest $accountRequest
     * @param ProfessionEditRequest $professionRequest
     * @param UserEditRequest $userRequest
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateProfile(AccountEditRequest $accountRequest,
                                  ProfessionEditRequest $professionRequest,
                                  UserEditRequest $userRequest, $id)
    {
        $code = $this->service->updateFProfile($accountRequest, $professionRequest, $userRequest, $id);
dd($code);
//        if (is_numeric($code))
//            return response()->json(['error' => true, 'message' => getErrorMessage($code)], 500);
//        else {
//            return response()->json(['success' => true, 'user' => $id, 200]);
//        }
    }

    /**
     * @param AccountApproveRequest $accountRequest
     * @param ProfessionApproveRequest $professionRequest
     * @param $id
     * @param AccountService $service
     * @return \Illuminate\Http\JsonResponse
     */
    public function editApprove(AccountApproveRequest $accountRequest,
                                ProfessionApproveRequest $professionRequest, $id)
    {

        try {

            $this->service->updateFAccount($accountRequest, $professionRequest, $id);

            return response()->json(['success' => 'pending', 'user' => $id], 200);
        } catch (\Exception $exception) {
            logger()->error($exception);
            return response()->json(['error' => true], 500);


        }
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
            ])->where('id', $user->account_id)->first();

        return response()->json([
            'access_token' => $token,
            'user' => $account,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60 * 3
        ]);
    }

    /**
     * @param PasswordRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function changePassword(PasswordRequest $request, $id)
    {
        try {
            $user = User::where('account_id', $id)->first();
            if (!Hash::check($request->old_password, $user->password)) {
                return response()->json(['error' => false, 'user' => $id], 401);
            } else {
                $this->service->updatePassword($request, $id);
                return response()->json([
                    'success' => true,
                    'user' => $id,
                ]);
            }
//
        } catch (MethodNotAllowedHttpException $exception) {
            logger()->error($exception);
            return response()->json(['success' => false, 'user' => $id], 500);
        }
    }

    /**
     * @return mixed
     */
    public function guard()
    {
        return \Auth::Guard('api');
    }
}
