<?php
/**
 * Created by PhpStorm.
 * User: Gtech-pc
 * Date: 06.08.2020
 * Time: 15:19
 */

namespace App\Services;


use App\Models\Account;
use App\Models\Message;
use App\Models\Profession;
use App\Models\User;
use App\Notifications\ManageUserStatus;
use App\Repositories\Repository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;


/**
 * Class AccountService
 * @package App\Services
 */
class AccountService
{
    /**
     * @var Repository
     */
    private $model;

    /**
     * AccountService constructor.
     * @param Account $account
     */
    public function __construct(Account $account)
    {
        $this->model = new Repository($account);
    }


    /**
     * get list of accounts by role
     * @param $role
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAccountList($role)
    {
        $accounts = $this->model->with([
            'user' => function ($query) {
                $query->select(['email', 'account_id', 'status']);
            },
            'prof' => function ($query) {
                $query->select(['account_id', 'specialty_id']);
            },
            'account_course'=>function($query){
                $query->select(['account_id', 'course_id']);
            },
            'prof.spec.type' => function ($query) {
                $query->select(['id', 'name']);
            }])->select('id', 'name', 'surname', 'image_name', 'phone')
            ->where('role', $role)->get();

        if (!$accounts)
            throw new ModelNotFoundException('User not found by ID ');
        return $accounts;
    }

    /**
     * get account by id
     * @param $role
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAccount()
    {
        $account = $this->model->with([
            'user' => function ($query) {
                $query->select(['email', 'account_id', 'status']);
            },
            'prof' => function ($query) {
                $query->select(['account_id', 'specialty_id', 'diplomas']);
            },
            'prof.spec.type' => function ($query) {
                $query->select(['id', 'name']);
            }]);
        if (!$account)
            throw new ModelNotFoundException('User not found by ID ');
        return $account;
    }

    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|object|null
     */
    public function getFAccountById($id)
    {
        $account = DB::table('accounts as a')
            ->join('professions as p', 'a.id', '=', 'p.account_id')
            ->join('specialties AS s', 's.id', '=', 'p.specialty_id')
            ->join('specialties AS sp', 'sp.id', '=', 's.parent_id')
            ->join('users AS u', 'u.account_id', '=', 'a.id')
            ->select('a.id', 'a.name', 'a.surname', 'a.father_name', 'a.image_name',
                'a.bday', 'u.email', 'a.phone', 'a.home_address', 'a.work_address', 'a.workplace_name',
                'p.specialty_id as specialty_id', 'sp.id as education_id', 's.type_id as profession', 'p.info')
            ->where('a.id', '=', $id)
            ->first();

        if (!$account)
            throw new ModelNotFoundException('User not found by ID ');
        return $account;

    }

    /**
     * @param $id
     * @return mixed
     */
    public function getFAccount($id)
    {
        $account = Account::select('id', 'name', 'surname', 'father_name', 'date_of_expiry', 'passport', 'date_of_issue')->where('id', $id)
            ->with(['prof' => function ($query) {
                $query->select(['specialty_id', 'member_of_palace', 'diplomas', 'account_id']);
            }])->first();
        if (!$account)
            throw new ModelNotFoundException('User not found by ID ');
        return $account;
    }


    /**
     * @param $account
     * @return mixed
     */
    public function addresses($account)
    {

        $home_address = json_decode($account->home_address, true);

        if (!empty($home_address['h_region']))
            $account->h_region = getRegionName($home_address['h_region']);
        if (!empty($home_address['h_street']))
            $account->h_street = $home_address['h_street'];
        if (!empty($home_address['h_territory']))
            $account->h_territory = getRegionName($home_address['h_territory']);

        $work_address = json_decode($account->work_address, true);

        if (!empty($work_address['w_region']))

            $account->w_region = getRegionName($work_address['w_region']);
        if (!empty($work_address['w_street']))
            $account->w_street = $work_address['w_street'];
        if (!empty($work_address['w_territory']))
            $account->w_territory = getRegionName($work_address['w_territory']);
        return $account;

    }

    /**
     * @param $accounts
     * @return mixed
     */
    public function getAddresses($accounts)
    {

        foreach ($accounts as $index => $account) {

            $home_address = json_decode($account->home_address, true);

            $accounts[$index]->h_region = getRegionName($home_address['h_region']);
            $accounts[$index]->h_street = $home_address['h_street'];
            $accounts[$index]->h_territory = getRegionName($home_address['h_territory']);

            $work_address = json_decode($account->work_address, true);
            $accounts[$index]->w_region = getRegionName($work_address['w_region']);
            $accounts[$index]->w_street = $work_address['w_street'];
            $accounts[$index]->w_territory = getRegionName($work_address['w_territory']);

            $profession = $this->getProfessions($account->id);
            $accounts[$index]->profession = $profession;
        }
        return $accounts;
    }


    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|object|null
     */
    public function getProfessions($id)
    {
        $profession = DB::table('professions AS p')
            ->join('specialties AS s', 's.id', '=', 'p.specialty_id')
            ->join('specialties AS sp', 'sp.id', '=', 's.parent_id')
            ->join('specialties_types AS st', 'st.id', '=', 's.type_id')
            ->select('s.icon', 'sp.name as edu_name',
                's.name AS spec_name', 'st.name AS type_name', 'p.specialty_id', 'p.member_of_palace', 's.parent_id')
            ->where('p.account_id', '=', $id)
            ->first();
        if (!$profession)
            throw new ModelNotFoundException('User not found by ID ');
        return $profession;
    }

    /**
     * @param $accountRequest
     * @param $profRequest
     * @param $userRequest
     * @param $id
     */
    public function updateAccount($accountRequest, $profRequest, $userRequest, $id)
    {
        DB::beginTransaction();
        try {
            $account = [];
            $account['name'] = $accountRequest->name;
            $account['surname'] = $accountRequest->surname;
            $account['father_name'] = $accountRequest->father_name;
            $account['phone'] = $accountRequest->phone;
            $account['passport'] = $accountRequest->passport;
            $account['bday'] = date("Y-m-d", strtotime($accountRequest->bday));
            $account['date_of_issue'] = date("Y-m-d", strtotime($accountRequest->date_of_issue));
            $account['date_of_expiry'] = date("Y-m-d", strtotime($accountRequest->date_of_expiry));
            $account['workplace_name'] = $accountRequest->workplace_name;
            $account['home_address'] = $this->addressToJson($accountRequest->h_region, $accountRequest->h_territory, $accountRequest->h_street, 'h');
            $account['work_address'] = $this->addressToJson($accountRequest->w_region, $accountRequest->w_territory, $accountRequest->w_street, 'w');
            $this->model->update($account, $id);
            $this->updateProfession($profRequest, $id);
            self::updateUserByParam($userRequest->email, $id, 'email');
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
            self::updateUserByParam('pending', $id, 'status');

            $message = Message::where('key', 'registered_user')->first();
            $account = Account::where('id', $id)->first();
            $user = User::select('email')->where('account_id', $id)->first();

            $user->notify(new ManageUserStatus($user, $account, $message));
            DB::commit();
        } catch (\Exception $exception) {
            dd($exception);
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

            $uu = self::updateUserByParam($userRequest->email, $id, 'email');

//            DB::commit();
            return true;
        } catch (\Exception $exception) {
            DB::rollback();
            return $exception->getCode();
        }
    }


    /**
     * @param $id
     * @return int
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
        if (!$inserted)
            throw new ModelNotFoundException('insert chi eghel ');
        return $inserted;
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
        if (!$inserted)
            throw new ModelNotFoundException('insert chi eghel ');
        return $inserted;
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

        if (!$inserted)
            throw new ModelNotFoundException('insert chi eghel ');
        return $inserted;
    }


    /**
     * @param $userRequest
     * @param $id
     * @param $param
     * @return mixed
     */
    static function updateUserByParam($userRequest, $id, $param)
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


