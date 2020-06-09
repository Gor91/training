<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\AccountRequest;
use App\Http\Requests\ProfessionRequest;
use App\Http\Requests\UserRequest;
use App\Models\Account;
use App\Models\Profession;
use App\Models\User;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
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
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(AccountRequest $accountRequest,
                             ProfessionRequest $professionRequest,
                             UserRequest $userRequest)
    {

        DB::beginTransaction();
        try {
            $home_address = [];
            $work_address = [];
            $home_address['h_region'] = $accountRequest->h_region;
            $work_address['w_region'] = $accountRequest->w_region;
            $home_address['h_city'] = $accountRequest->h_city;
            $work_address['w_city'] = $accountRequest->w_city;
            $home_address['h_village'] = $accountRequest->h_village;
            $work_address['w_village'] = $accountRequest->w_village;
            $home_address['h_street'] = $accountRequest->h_street;
            $work_address['w_street'] = $accountRequest->w_street;
            $account = new Account();
            $account->name = $accountRequest->name;
            $account->surname = $accountRequest->surname;
            $account->father_name = $accountRequest->father_name;
            $account->gender = $accountRequest->gender;
            $account->married_status = $accountRequest->married_status;
            $account->bday = date("Y-m-d", strtotime($accountRequest->bday));
            $account->phone = $accountRequest->phone;
            $account->passport = $accountRequest->passport;
            $account->date_of_issue = date("Y-m-d", strtotime($accountRequest->date_of_issue));
            $account->date_of_expiry = date("Y-m-d", strtotime($accountRequest->date_of_expiry));
            $account->workplace_name = $accountRequest->workplace_name;
            $account->image_name = $accountRequest->gender . ".png";
            $account->work_address = json_encode($work_address, true);
            $account->home_address = json_encode($home_address, true);
            $account->save();

            $allFiles = $professionRequest->allFiles();
            $a_f = [];
            if (!Storage::exists(Config::get('constants.DIPLOMA'))) {
                Storage::makeDirectory(Config::get('constants.DIPLOMA'), 0775, true);
            }
            foreach ($allFiles as $index => $allFile) {
                $name = grs() . "_" . $account->id . "." . $allFile->extension();
                $a_f[] = $name;
                $allFile->move(storage_path() . Config::get('constants.APP') . Config::get('constants.DIPLOMA'), $name);
            }
            $prof = new Profession();
            $prof->account_id = $account->id;
            $prof->specialty_id = $professionRequest->specialty_id;
            $prof->education_id = $professionRequest->education_id;
            $prof->profession = $professionRequest->profession;
            if (!empty($professionRequest->member_of_palace))
                $prof->member_of_palace = $professionRequest->member_of_palace;
            $prof->diplomas = json_encode($a_f, true);
            $prof->save();

            $user = new User();
            $user->account_id = $account->id;
            $user->email = $userRequest->email;
            $user->password = bcrypt($userRequest->password);

            $user->save();
            DB::commit();

            return response()->json(['success' => true, 'user' => $account->id, 200]);
        } catch (\Exception $exception) {
            DB::rollback();
            dd($exception);
            logger()->error($exception);
            return response()->json(['error' => true, 500]);
//            return redirect('backend/users')->with('error', Lang::get('messages.wrong'));

        }
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);
        if (!$token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
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
        return $this->respondWithToken(auth('api')->refresh());
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

        $account = Account::select(['id', 'name', 'surname', 'father_name', 'gender', 'image_name'])
            ->with([
                'user' => function ($query) {
                    $query->select(['account_id', 'email']);
                },
                'prof' => function ($query) {
                    $query->select(['account_id', 'profession', 'member_of_palace']);
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

    public function guard()
    {
        return \Auth::Guard('api');
    }
}
