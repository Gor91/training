<?php

namespace App\Http\Controllers\Backend;

use App\Exports\AccountExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\AccountRequest;
use App\Http\Requests\ProfessionEditRequest;
use App\Http\Requests\ProfessionRequest;
use App\Http\Requests\UserEditRequest;
use App\Http\Traits\Address;
use App\Http\Traits\Expert;
use App\Http\Traits\Registration;
use App\Repositories\Repository;
use App\Services\AccountService;
use App\Services\GPDFService;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

class AccountController extends Controller
{
    use Address;
    use Expert;
    use Registration;

    // space that we can use the repository from
    /**
     * @var Repository
     */
    protected $service;
    /**
     * @var
     */
    protected $role = 'user';


    /**
     * AccountController constructor.
     * @param AccountService $service
     */
    public function __construct(AccountService $service)
    {
        // set the service
        $this->service = $service;
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($role)
    {
        $this->role = $role;
        Session::put('role', $role);
        try {
            $accounts = $this->service->getAccountList($role);

            return view('backend.account.index',
                compact('accounts', 'role'));
        } catch (ModelNotFoundException $exception) {
            logger()->error($exception);
            return redirect('backend/account/' . $role)->with('error', __('messages.wrong'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            $regions = $this->getRegions();
            $regions = $regions->getData();
            $prof = $this->getProfession();
            $prof = (array)$prof->getData()->prof;
            return view('backend.account.create', compact('regions', 'prof'));
        } catch (ModelNotFoundException $exception) {
            dd($exception);
            logger()->error($exception);
            return redirect('backend/account/' . $this->role)->with('error', __('messages.wrong'));
        }
    }


    /**
     * @param AccountRequest $accountRequest
     * @param ProfessionRequest $professionRequest
     * @param UserEditRequest $userRequest
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(AccountRequest $accountRequest,
                          ProfessionRequest $professionRequest,
                          UserEditRequest $userRequest)
    {
        try {
            Registration::register($accountRequest, $professionRequest, $userRequest, 'lecture', 'approved');

            return redirect('backend/account/lecture')->with('success', __('messages.success'));
        } catch (\Exception $exception) {
            dd($exception);
            logger()->error($exception);
            return redirect('backend/account/lecture')->with('error', __('messages.wrong'));
        }
    }

    /**
     * Display the specified resource.
     * @param $id
     * @param AccountService $service
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function show($id)
    {
        try {

            $account = $this->service->getAccount()->where('id', $id)->first();
            if (!empty($account)) {
                $account = $this->service->addresses($account);
            }
            $profession = $this->service->getProfessions($id);
            return view('backend.account.show',
                compact('account', 'profession'));
        } catch (MethodNotAllowedHttpException $exception) {

            logger()->error($exception);
            return redirect('backend/account/' . $this->role)->with('error', __('messages.wrong'));
        }
    }


    /**
     * Show the form for editing the specified resource.
     * @param $id
     * @param AccountService $service
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function edit($id)
    {
        try {
            $account = $this->service->getAccount()->where('id', $id)->first();
            if (!empty($account)) {
                $account = $this->service->addresses($account);

                $regions = $this->getRegions();
                $regions = $regions->getData();
                $profession = $this->service->getProfessions($id);
                $prof = $this->getProfession();
                $prof = (array)$prof->getData()->prof;

                return view('backend.account.edit',
                    compact('account', 'profession', 'regions', 'prof'));
            } else
                return redirect('backend/account/' . $this->role)->with('error', __('messages.wrong'));
        } catch (\Exception $exception) {
            logger()->error($exception);
            return redirect('backend/account/' . $this->role)->with('error', __('messages.wrong'));
        }
    }


    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param $id
     * @param AccountService $service
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        try {
            $this->service->updateApproved($id);
            return redirect('backend/account/user')->with('success', __('messages.updated'));
        } catch (MethodNotAllowedHttpException $exception) {
            logger()->error($exception);
            return redirect('backend/account/user')->with('error', __('messages.wrong'));
        }
    }


    /**
     * Update the specified resource in storage.
     * @param AccountRequest $accountRequest
     * @param ProfessionEditRequest $professionRequest
     * @param UserEditRequest $userRequest
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function updateAccount(AccountRequest $accountRequest, ProfessionEditRequest $professionRequest,
                                  UserEditRequest $userRequest, $id)
    {

        try {
            $this->service->updateAccount($accountRequest, $professionRequest, $userRequest, $id);

            return redirect('backend/account/lecture')->with('success', __('messages.updated'));
        } catch (\Exception $exception) {
            dd($exception);
            logger()->error($exception);
            return redirect('backend/account/lecture')->with('error', __('messages.wrong'));
        }
    }


    /**
     * Remove the specified resource from storage.
     * @param $id
     * @param AccountService $service
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        //TODO check courses unlink diploma files
        try {
            $this->service->delete($id);
            return back()->with('success', __('messages.deleted'));
        } catch (\Exception $exception) {
            dd($exception);
            logger()->error($exception);
            return redirect('backend/account/' . $this->role)->with('error', __('messages.wrong'));
        }
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTerritory(Request $request)
    {
        if($request->ajax())
        return Address::getTerritories($request->id);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getEducation(Request $request)
    {
        return Expert::getSpecialty($request->id);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSpecialty(Request $request)
    {
        return Expert::getEducation($request->id);
    }

    /**
     * @param AccountService $service
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function gdPDFRole()
    {
        try {
            $accounts = $this->service->getAccount()->get();

            if (!empty($accounts)) {
                $accounts = $this->service->getAddresses($accounts);
            }

            $data = $accounts;
            $path = 'accounts.pdf';
            $load_page = 'backend.account.gd_role_pdf';
            $const = 'constants.ACCOUNT_PATH';
            $pdf = GPDFService::gdPDF($path, $load_page, $const, $data);

            return response()->download($pdf);
        } catch (\Exception $exception) {
            logger()->error($exception);
            return redirect('backend/account/' . $this->role)->with('error', __('messages.wrong'));
        }

    }

    /**
     * @param $id
     * @param AccountService $service
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function gdPDF($id)
    {
        try {
            $account = $this->service->getAccount()->where('id', $id)->first();
            if (!empty($account)) {
                $account = $this->service->addresses($account);
            }
            $profession = $this->service->getProfessions($id);

            $account->profession = $profession;


            $data = $account;
            $path = 'account-' . $id . '.pdf';
            $load_page = 'backend.account.gd_pdf';
            $const = 'constants.ACCOUNT_PATH';
            $pdf = GPDFService::gdPDF($path, $load_page, $const, $data);

            return response()->download($pdf);

        } catch (\Exception $exception) {
            logger()->error($exception);
            dd($exception);
            return redirect('backend/account/' . $this->role)->with('error', __('messages.wrong'));
        }
    }

    /**
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function gdExcel()
    {
        $role = Session::get('role');
        return Excel::download(new AccountExport($role),
            'accounts.xlsx');
    }

}
