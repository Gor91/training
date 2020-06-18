<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Region;
use App\Repositories\Repository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;

class AccountController extends Controller
{
    // space that we can use the repository from
    protected $model;

    public function __construct(Account $account)
    {
        // set the model
        $this->model = new Repository($account);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $accounts = $this->model->with([
                'user' => function ($query) {
                    $query->select(['email', 'account_id', 'status']);
                },
                'prof' => function ($query) {
                    $query->select(['account_id', 'profession']);
                }]);

            return view('backend.account.index',
                compact('accounts'));
        } catch (\Exception $exception) {
            dd($exception);
            logger()->error($exception);
            return redirect('backend/dashboard')->with('error', Lang::get('messages.wrong'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $accounts = $this->model->with([
                'user' => function ($query) {
                    $query->select(['email', 'account_id', 'status']);
                },
                'prof' => function ($query) {
                    $query->select(['account_id', 'profession', 'diplomas']);
                }])->where('id', $id);
            $account = [];
            if (!empty($accounts)) {
                foreach ($accounts as $index => $acc) {
                    $account = $acc;
                }
                $home_address = json_decode($account->home_address, true);
                $account->h_region = $this->getRegionName($home_address['h_region']);
                $account->h_street = $home_address['h_street'];
                $account->h_territory = $this->getRegionName($home_address['h_territory']);

                $work_address = json_decode($account->work_address, true);
                $account->w_region = $this->getRegionName($work_address['w_region']);
                $account->w_street = $work_address['w_street'];
                $account->w_territory = $this->getRegionName($work_address['w_territory']);
            }


            $profession = DB::table('professions AS p')
                ->join('specialties AS s', 's.id', '=', 'p.specialty_id')
                ->join('specialties AS sp', 's.parent_id', '=', 'sp.id')
                ->join('educations AS e', 'e.id', '=', 'p.education_id')
                ->select('e.name AS edu_name', 's.icon',
                    's.name AS name', 'sp.name AS spec_name')
                ->where('p.account_id', '=', $id)
                ->first();

            return view('backend.account.show',
                compact('account', 'profession'));
        } catch (\Exception $exception) {
            dd($exception);
            logger()->error($exception);
            return redirect('backend/dashboard')->with('error', Lang::get('messages.wrong'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getRegionName($id)
    {
        $region = Region::select('name')
            ->where('id', $id)
            ->first();
        return $region->name;
    }
}
