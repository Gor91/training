<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\AccountApproveRequest;
use App\Http\Requests\AccountEditRequest;
use App\Http\Requests\PasswordRequest;
use App\Http\Requests\ProfessionApproveRequest;
use App\Http\Requests\ProfessionEditRequest;
use App\Http\Requests\UserEditRequest;
use App\Models\Account;
use App\Models\Profession;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;


class AccountController extends Controller
{
    /**
     * Create a new AccountController instance.
     *
     * @return void
     */
    public function __construct()
    {
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
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function editProfile(Request $request, $id)
    {
        $profile = DB::table('accounts as a')
            ->join('professions as p', 'a.id', '=', 'p.account_id')
            ->join('specialties AS s', 's.id', '=', 'p.specialty_id')
            ->join('users AS u', 'u.account_id', '=', 'a.id')
            ->select('a.id', 'a.name', 'a.surname', 'a.father_name',
                'a.bday', 'u.email', 'a.phone', 'a.home_address', 'a.work_address', 'a.workplace_name',
                'p.specialty_id as education_id', 's.parent_id as specialty_id', 's.type_id as profession')
            ->where('a.id', '=', $id)
            ->first();
        $approve = Account::select('id', 'name', 'surname', 'father_name', 'date_of_expiry', 'passport', 'date_of_issue')->where('id', $id)
            ->with(['prof' => function ($query) {
                $query->select(['specialty_id', 'member_of_palace', 'diplomas', 'account_id']);
            }])->first();

        return response()->json([
            'access_token' => $request->token,
            'user' => $profile,
            'app' => $approve,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }

    public function avatar(Request $request)
    {
//todo transaction
        $this->validate($request, [
//            'id' => 'required|integer',
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $id = $request->id;
        if ($request->hasFile('avatar')) {
            $aup = public_path() . Config::get('constants.UPLOADS') . Config::get('constants.AVATAR_PATH_UPLOADED');
            if (!file_exists($aup))
                mkdir($aup, 0755, true);
            $name = 'avatar_' . $id . '.' . $request->file('avatar')->extension();
            $send = $request->file('avatar')->move($aup, $name);
            $account = Account::find($id);
            $image_name = $account->image_name;
            $account->image_name = $name;
            $account->save();
            if ($image_name !== Config::get('constants.AVATAR')
                && $name !== $image_name)
                unlink($aup . $image_name);

//            return response()->json(['success' => true, 'avatar' => $name, 200]);
            return $this->respondWithToken($request->token);
        }
    }

    public function updateProfile(AccountEditRequest $accountRequest,
                                  ProfessionEditRequest $professionRequest,
                                  UserEditRequest $userRequest, $id)
    {
        DB::beginTransaction();
        try {
            $home_address = [];
            $work_address = [];
            $home_address['h_region'] = $accountRequest->h_region;
            $work_address['w_region'] = $accountRequest->w_region;
            $home_address['h_territory'] = $accountRequest->h_territory;
            $work_address['w_territory'] = $accountRequest->w_territory;
            $home_address['h_street'] = $accountRequest->h_street;
            $work_address['w_street'] = $accountRequest->w_street;
            $account = Account::find($id);
            $account->bday = date("Y-m-d", strtotime($accountRequest->bday));
            $account->phone = $accountRequest->phone;
            $account->workplace_name = $accountRequest->workplace_name;
            $account->work_address = json_encode($work_address, true);
            $account->home_address = json_encode($home_address, true);
            $account->save();
            Profession::where('account_id', $id)
                ->update([
                    'account_id' => $account->id,
                    'specialty_id' => $professionRequest->education_id,
//                    'education_id' => $professionRequest->,
//                    'profession' => $professionRequest->profession,

                ]);
            $user = User::where('account_id', $id)->update([
                'email' => $userRequest->email
            ]);
            DB::commit();
            return response()->json(['success' => true, 'user' => $account->id, 200]);
        } catch (\Exception $exception) {
            DB::rollback();
            dd($exception);
            logger()->error($exception);
            return response()->json(['error' => true], 500);
//            return redirect('backend/users')->with('error', Lang::get('messages.wrong'));

        }
    }

    public function editApprove(AccountApproveRequest $accountRequest,
                                ProfessionApproveRequest $professionRequest, $id)
    {
        DB::beginTransaction();
        try {

            $account = Account::find($id);
            $account->name = $accountRequest->name;
            $account->surname = $accountRequest->surname;
            $account->father_name = $accountRequest->father_name;
            $account->passport = $accountRequest->passport;
            $account->date_of_issue = date("Y-m-d", strtotime($accountRequest->date_of_issue));
            $account->date_of_expiry = date("Y-m-d", strtotime($accountRequest->date_of_expiry));
            $account->save();

            $allFiles = $professionRequest->allFiles();
            $a_f = [];
            if (strlen($professionRequest->diplomas) > 0) {
                $a_f = explode(',', $professionRequest->diplomas);
            }
//            if (!file_exists(Config::get('constants.DIPLOMA'))) {
//                mkdir(Config::get('constants.DIPLOMA'), 0775, true);
//            }
            foreach ($allFiles as $index => $allFile) {
                $name = grs() . "_" . $account->id . "." . $allFile->extension();
                $a_f[] = $name;
                $allFile->move(public_path() . Config::get('constants.DIPLOMA'), $name);
            }

            Profession::where('account_id', $id)
                ->update([
                    'member_of_palace' => (int)$professionRequest->member_of_palace,
                    'diplomas' => json_encode($a_f, true)
                ]);
            User::where('account_id', $id)
                ->update([
                    'status' => 'pending'
                ]);
//todo unlink diplomas
            DB::commit();

            return response()->json(['success' => 'pending', 'user' => $account->id], 200);
        } catch (\Exception $exception) {
            DB::rollback();
//            dd($exception);
            logger()->error($exception);
            return response()->json(['error' => true], 500);
//            return redirect('backend/users')->with('error', Lang::get('messages.wrong'));

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
//        $user = $this->guard()->user();
        $account = Account::select(['id', 'name', 'surname', 'father_name', 'image_name'])
            ->with([
                'user' => function ($query) {
                    $query->select(['account_id', 'email']);
                },
                'prof' => function ($query) {
                    $query->select(['account_id', 'profession', 'member_of_palace']);
                }
            ])->first();

        return response()->json([
            'access_token' => $token,
            'user' => $account,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60 * 3
        ]);
    }

    public function changePassword(PasswordRequest $request, $id)
    {
        try {

            $user = User::where('account_id', $id)->first();
            if (!Hash::check($request->old_password, $user->password)) {
                return response()->json(['error' => false, 'user' => $id, 401]);
            } else {
                $user->password = bcrypt($request->password);
                $user->save();
                return response()->json([
                    'success' => true,
                    'user' => $id,
                ]);
            }
//
        } catch (\Exception $exception) {
            logger()->error($exception);
            return response()->json(['success' => false, 'user' => $id, 500]);
        }
    }

    public function guard()
    {
        return \Auth::Guard('api');
    }
}
