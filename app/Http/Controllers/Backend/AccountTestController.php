<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Repositories\Repository;
use App\Services\AccountCourseService;
use App\Services\GPDFService;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AccountTestController extends Controller
{

    // space that we can use the repository from
    /**
     * @var Repository
     */
    protected $service;

    /**
     * AccountController constructor.
     * @param AccountCourseService $service
     */
    public function __construct(AccountCourseService $service)
    {
        // set the service
        $this->service = $service;
        $this->middleware('auth:admin');
    }

    public function index($id)
    {

        try {
            $tests = $this->service->getTestsResult($id);
            return view('backend.accounttest.index', compact('tests', 'id'));
        } catch (ModelNotFoundException $exception) {
            dd($exception);
            logger()->error($exception);
            return redirect('backend/index/' . $id)->with('error', __('messages.wrong'));
        }
    }


    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($a_id, $id)
    {
        try {
            $tests = $this->service->getTestById($a_id, $id);

            $account = $this->service->getAccountById($a_id);
            return view('backend.accounttest.show', compact('tests', 'id', 'account'));
        } catch (ModelNotFoundException $exception) {
            dd($exception);
            logger()->error($exception);
            return redirect('backend/index/' . $id)->with('error', __('messages.wrong'));
        }
    }

    public function gdPDF($id)
    {
        try {
            $accountTests = $this->service->getTestsResult($id);
            $account = $this->service->getAccountById($id);
            $data = ['account' => $account,
                'at' => $accountTests];
            $path = 'account-tests-' . $id . '.pdf';
            $load_page = 'backend.accounttest.gd_pdf';
            $const = 'constants.ACCOUNT_PATH';
            $pdf = GPDFService::gdPDF($path, $load_page, $const, $data);

            return response()->download($pdf);

        } catch (\Exception $exception) {
            logger()->error($exception);
            dd($exception);
            return redirect('backend/account/' . $id)->with('error', __('messages.wrong'));
        }
    }

    public function gdPDFTest($a_id, $id)
    {

        try {
            $data = $this->service->getTestById($a_id, $id);

            $path = 'account-test-' . $a_id . "-" . $id . '.pdf';
            $load_page = 'backend.accounttest.gd_pdf_test';
            $const = 'constants.ACCOUNT_PATH';
            $pdf = GPDFService::gdPDF($path, $load_page, $const, $data);

            return response()->download($pdf);

        } catch (\Exception $exception) {
            logger()->error($exception);
            dd($exception);
            return redirect('backend/account/' . $id)->with('error', __('messages.wrong'));
        }
    }

    public function sendAttachment()
    {

        $test = request('test');
        if (isset($test)) {

            $this->gdPDFTest(request('id'), request('test_id'));
        }
        $base = new BaseController();
        $base->sendEmail(request());
    }
}
