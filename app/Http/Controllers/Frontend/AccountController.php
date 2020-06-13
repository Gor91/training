<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\AccountRequest;
use App\Http\Requests\PasswordRequest;
use App\Http\Requests\ProfessionRequest;
use App\Http\Requests\UserEditRequest;
use App\Models\Account;
use App\Models\Profession;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
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
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
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
        $profile = DB::table('accounts')
            ->join('users', 'accounts.id', '=', 'users.account_id')
            ->join('professions', 'accounts.id', '=', 'professions.account_id')
            ->select('accounts.*',
                'users.email',
                'professions.*')
            ->where('accounts.id', '=', $id)
            ->first();
        return response()->json([
            'access_token' => $request->token,
            'user' => $profile,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }

    public function avatar(Request $request)
    {

        $this->validate($request, [
//            'id' => 'required|integer',
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $id = $request->id;
        if ($request->hasFile('avatar')) {
            $name = 'avatar_' . $id . '.' . $request->file('avatar')->extension();
            $send = $request->file('avatar')->move(storage_path() . Config::get('constants.APP') . Config::get('constants.AVATAR_PATH'), $name);
//dd($send);
            $account = Account::find($id);
            $account->image_name = $name;
            $account->save();
//            return response()->json(['success' => true, 'avatar' => $name, 200]);
            return $this->respondWithToken($request->token);
        }

    }

    public function updateProfile(AccountRequest $accountRequest,
                                  ProfessionRequest $professionRequest,
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
            $account->image_name = $accountRequest->image_name;
            $account->work_address = json_encode($work_address, true);
            $account->home_address = json_encode($home_address, true);
            $account->save();

            $allFiles = $professionRequest->allFiles();
            $a_f = [];
            if (strlen($professionRequest->diplomas) > 0) {
                $a_f = explode(',', $professionRequest->diplomas);
            }
            if (!Storage::exists(Config::get('constants.DIPLOMA'))) {
                Storage::makeDirectory(Config::get('constants.DIPLOMA'), 0775, true);
            }
            foreach ($allFiles as $index => $allFile) {
                $name = grs() . "_" . $account->id . "." . $allFile->extension();
                $a_f[] = $name;
                $allFile->move(storage_path() . Config::get('constants.APP') . Config::get('constants.DIPLOMA'), $name);
            }

            Profession::where('account_id', $id)
                ->update([
                    'account_id' => $account->id,
                    'specialty_id' => $professionRequest->specialty_id,
                    'education_id' => $professionRequest->education_id,
                    'profession' => $professionRequest->profession,
                    'member_of_palace' => $professionRequest->member_of_palace,
                    'diplomas' => json_encode($a_f, true)]);
            $user = User::where('account_id', $id)->update([
                'email' => $userRequest->email
            ]);
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
     * Get the token array structure.
     *
     * @param string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
//        $user = $this->guard()->user();
        $account = Account::select(['id', 'name', 'surname', 'father_name', 'gender', 'image_name'])
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
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }

    public function changePassword(PasswordRequest $request, $id)
    {
        try {

            $user = User::where('account_id', $id)->first();

            if (!Hash::check($request->old_password, $user->password)) {
                return response()->json(['success' => false, 'user' => $id, 401]);
            } else {
                $user->password = bcrypt($request->password);
                $user->save();
                return response()->json([
                    'access_token' => $request->_token,
                    'user' => $user,
                    'token_type' => 'bearer',
                    'expires_in' => auth('api')->factory()->getTTL() * 60
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
