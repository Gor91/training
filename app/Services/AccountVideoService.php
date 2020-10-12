<?php
/**
 * Created by PhpStorm.
 * User: Gtech-pc
 * Date: 06.08.2020
 * Time: 15:19
 */

namespace App\Services;


use App\Models\Account;
use App\Models\AccountVideo;
use App\Models\Message;
use App\Models\Profession;
use App\Models\User;
use App\Models\Videos;
use App\Notifications\ManageUserStatus;
use App\Repositories\Repository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;


/**
 * Class AccountService
 * @package App\Services
 */
class AccountVideoService
{
    /**
     * @var Repository
     */
    private $model;

    /**
     * AccountService constructor.
     * @param AccountVideo $av
     */
    public function __construct(AccountVideo $av)
    {
        $this->model = new Repository($av);
    }

    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|object|null
     */
    public function getVideoById($id)
    {
        $video = $this->model->where([['video_id', '=', $id]]);
//          dd($video);
        if (!$video)
            throw new ModelNotFoundException('User not found by ID ');
        return $video;

    }


    public function addPointById($request)
    {

        DB::beginTransaction();
        try {
            $video = [];
            $video['video_id'] = $request->id;
            $video['account_id'] = $request->user_id;
            $video['point'] = $request->point;
            $duration = Videos::select('duration')->where('id', $request->id)->first();

            (ceil($request->point) < ceil($duration->duration)) ?
                $video['status'] = "progress" :
                $video['status'] = "finished";
            $getId = AccountVideo::select('id')->where([["video_id", $request->id], ['account_id', $request->user_id]])->first();
            (empty($getId ))?
                $this->model->create($video)
                :
                $this->model->update($video, $getId->id);

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollback();
            logger()->error($exception);
        }
    }

    /**
     * @param $accountRequest
     * @param $profRequest
     * @param $id
     */
    public function updateFAccount($accountRequest, $profRequest, $id)
    {
        DB::beginTransaction();
        try {
            $account = [];
            $account['name'] = $accountRequest->name;
            $account['surname'] = $accountRequest->surname;
            $account['father_name'] = $accountRequest->father_name;
            $account['passport'] = $accountRequest->passport;

            $account['date_of_issue'] = date("Y-m-d", strtotime($accountRequest->date_of_issue));
            $account['date_of_expiry'] = date("Y-m-d", strtotime($accountRequest->date_of_expiry));

            $this->model->update($account, $id);

            $this->updateProfession($profRequest, $id);
            $this->updateUserByParam('pending', $id, 'status');
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollback();
            logger()->error($exception);
        }
    }


    /**
     * @param $accountRequest
     * @param $professionRequest
     * @param $userRequest
     * @param $id
     * @return int|mixed
     */
    public function updateFProfile($accountRequest, $professionRequest, $userRequest, $id)
    {

//        DB::beginTransaction();
        try {
            $account = [];
            $account['bday'] = date("Y-m-d", strtotime($accountRequest->bday));
            $account['phone'] = $accountRequest->phone;
            $account['workplace_name'] = $accountRequest->workplace_name;
            $account['home_address'] = $this->addressToJson($accountRequest->h_region, $accountRequest->h_territory, $accountRequest->h_street, 'h');
            $account['work_address'] = $this->addressToJson($accountRequest->w_region, $accountRequest->w_territory, $accountRequest->w_street, 'w');

            $this->model->update($account, $id);

            Profession::where('account_id', $id)
                ->update([
                    'specialty_id' => $professionRequest->specialty_id,
                    'info' => $professionRequest->info
                ]);

            $uu = $this->updateUserByParam($userRequest->email, $id, 'email');

//            DB::commit();
            return true;
        } catch (\Exception $exception) {
            DB::rollback();
            return $exception->getCode();
        }
    }

    /**
     * updating a new resource/admin
     * @param $request
     * @param $id
     */
    public function updateApproved($id)
    {
        //todo kareli e poxel setmedodov
        $message = Message::where('key', 'approved_user')->first();
        $account = Account::select('name', 'surname')->where('id', $id)->first();
        $user = User::where('account_id', $id)->first();
        $inserted = DB::table('users')
            ->where('account_id', $id)
            ->update(['status' => "approved"]);
        $user->notify(new ManageUserStatus($user, $account, $message, true));
        if (!$inserted->id)
            throw new ModelNotFoundException('insert chi eghel ');
        return $inserted->id;
    }

    /**
     * @param $id
     */
    public function delete($id)
    {
        //todo kareli e poxel setmedodov
        $message = Message::where('key', 'rejected_user')->first();
        $account = Account::select('name', 'surname')->where('id', $id)->first();
        $user = User::where('account_id', $id)->first();

        $this->model->delete($id);
        $user->notify(new ManageUserStatus($user, $account, $message));
    }


    /**
     * @param $request
     * @param $id
     * @return mixed
     */
    public function updatePassword($request, $id)
    {
        $data = [];
        $data['password'] = bcrypt($request->password);
        $inserted = $this->model->update($data, $id);
        if (!$inserted->id)
            throw new ModelNotFoundException('insert chi eghel ');
        return $inserted->id;
    }


    /**
     * @param $professionRequest
     * @param $id
     * @return mixed
     */
    public function updateProfession($professionRequest, $id)
    {

        $allFiles = $professionRequest->allFiles();

        $a_f = [];

        if (strlen($professionRequest->diplomas) > 0) {
            $diplomas = json_decode($professionRequest->diplomas);
            $n_d = $this->getItem($id, 'diplomas');
            $n_d = json_decode($n_d->diplomas);

            if (!empty($diplomas) && !empty($n_d)) {
                $result = array_diff($n_d, $diplomas);
                foreach ($result as $index => $item) {
                    unlink(public_path() . Config::get('constants.DIPLOMA') . $item);
                }
                foreach ($diplomas as $index => $diploma) {
                    if (!empty($diploma))
                        $a_f[] = $diploma;
                }
            }


//            if (!file_exists(Config::get('constants.DIPLOMA'))) {
//                mkdir(Config::get('constants.DIPLOMA'), 0775, true);
//            }
            if (!empty($allFiles)) {
                foreach ($allFiles as $index => $allFile) {
                    $name = grs() . "_" . $id . "." . $allFile->extension();

                    $a_f[] = $name;
                    $allFile->move(public_path() . Config::get('constants.DIPLOMA'), $name);
                }
            } else
                $a_f = $n_d;
        }

        if (!empty($professionRequest->specialty_id))
            $specialty_id = $professionRequest->specialty_id;
        else {
            $specialty = $this->getItem($id, 'specialty_id');
            $specialty_id = $specialty->specialty_id;
        }

        $inserted = Profession::where('account_id', $id)
            ->update([
                'specialty_id' => $specialty_id,
                'member_of_palace' => (int)$professionRequest->member_of_palace,
                'diplomas' => json_encode($a_f, true),

            ]);
        if (!$inserted->id)
            throw new ModelNotFoundException('insert chi eghel ');
        return $inserted->id;
    }

    /**
     * @param $userRequest
     * @param $id
     */
    public function updateUserByParam($userRequest, $id, $param)
    {

        $updated = User::where('account_id', $id)->update([
            $param => $userRequest
        ]);

        if (!$updated)
            throw new ModelNotFoundException('insert chi eghel ');
        return $updated;
    }

    /**
     * @param $request
     * @return bool
     */
    public function updateFAvatar($request)
    {
        DB::beginTransaction();
        try {

            $id = $request->id;

            $aup = public_path() . Config::get('constants.UPLOADS') . Config::get('constants.AVATAR_PATH_UPLOADED');
            if (!file_exists($aup))
                mkdir($aup, 0755, true);
            $name = 'avatar_' . $id . '.' . $request->file('avatar')->extension();
            $request->file('avatar')->move($aup, $name);
            $account = Account::find($id);
            $image_name = $account->image_name;
            $account->image_name = $name;
            $account->save();
            if ($image_name !== Config::get('constants.AVATAR')
                && $name !== $image_name)
                unlink($aup . $image_name);

            DB::commit();
            return true;
        } catch (\Exception $exception) {
            DB::rollback();
//            dd($exception);
            logger()->error($exception);
            return false;
        }
    }

    /**
     * @param $region
     * @param $territory
     * @param $street
     * @param $type
     * @return false|string
     */
    public function addressToJson($region, $territory, $street, $type)
    {
        $address = [];
        $address[$type . '_region'] = $region;
        $address[$type . '_street'] = $street;
        $address[$type . '_territory'] = $territory;
        return json_encode($address, true);
    }

    /**
     * @param $id
     * @param $item
     * @return mixed
     */
    public function getItem($id, $item)
    {
        return Profession::select($item)
            ->where('account_id', $id)->first();
    }

}


