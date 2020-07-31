<?php
/**
 * Created by PhpStorm.
 * User: Gtech-pc
 * Date: 10.07.2020
 * Time: 13:39
 */

namespace App\Http\Traits;


use App\Models\Account;
use App\Models\Message;
use App\Models\Profession;
use App\Models\User;
use App\Notifications\ManageUserStatus;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

trait Registration
{
    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    static function register($accountRequest,
                             $professionRequest,
                             $userRequest, $role, $status)
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
            $account = new Account();
            $account->name = $accountRequest->name;
            $account->surname = $accountRequest->surname;
            $account->father_name = $accountRequest->father_name;
            $account->bday = date("Y-m-d", strtotime($accountRequest->bday));
            $account->phone = $accountRequest->phone;
            $account->passport = $accountRequest->passport;
            $account->date_of_issue = date("Y-m-d", strtotime($accountRequest->date_of_issue));
            $account->date_of_expiry = date("Y-m-d", strtotime($accountRequest->date_of_expiry));
            $account->workplace_name = $accountRequest->workplace_name;
            $account->work_address = json_encode($work_address, true);
            $account->home_address = json_encode($home_address, true);
            $account->role = $role;
            $account->save();
            $allFiles = $professionRequest->allFiles();
            $a_f = [];
            if (!file_exists(public_path() . Config::get('constants.DIPLOMA'))) {
                mkdir(Config::get('constants.DIPLOMA'), 0775, true);
            }
            foreach ($allFiles as $index => $allFile) {
                $name = grs() . "_" . $account->id . "." . $allFile->extension();
                $a_f[] = $name;
                $allFile->move(public_path() . Config::get('constants.DIPLOMA'), $name);
            }
            $prof = new Profession();
            $prof->account_id = $account->id;
            $prof->specialty_id = $professionRequest->specialty_id;
            $prof->education_id = $professionRequest->education_id;
            $prof->profession = $professionRequest->profession;
            if (!empty($professionRequest->member_of_palace))
                $prof->member_of_palace = (int)$professionRequest->member_of_palace;
            $prof->diplomas = json_encode($a_f, true);
            $prof->save();
//todo unlink diplomas

            $user = new User();
            $user->account_id = $account->id;
            $user->email = $userRequest->email;
            if ($role === 'user')
                $user->password = bcrypt($userRequest->password);
            else
                $user->password = bcrypt('11111111');
            $user->status = $status;
            if ($user->save()) {
                $message = Message::where('key', 'registered_' . $role)->first();
                $user->notify(new ManageUserStatus($user, $account, $message));
            }

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

}
