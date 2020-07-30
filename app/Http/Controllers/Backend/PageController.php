<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\PageRequest;
use App\Models\Page;
use App\Repositories\Repository;
use Illuminate\Support\Facades\Lang;

class PageController extends Controller
{
    // space that we can use the repository from
    protected $model;

    public function __construct(Page $page)
    {
        // set the model
        $this->model = new Repository($page);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $page_id = Page::where('slug','=','about')->first();
            $pages = $this->model->show($page_id->id);
            return view('backend.page.edit',
                compact('pages'));
        } catch (\Exception $exception) {
            dd($exception);
            logger()->error($exception);
            return redirect('backend/message')->with('error', Lang::get('messages.wrong'));
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
            return view('backend.message.create');
        } catch (\Exception $exception) {
            dd($exception);
            logger()->error($exception);
            return redirect('backend/message')->with('error', Lang::get('messages.wrong'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(PageRequest $request)
    {
        try {
            $data = [];
            $data['title'] = $request->title;
            $data['homedescription'] = $request->homedescription;
            $data['description'] = $request->description;
            $this->model->create($data);
            return redirect('backend/message')->with('success', Lang::get('messages.success'));
        } catch (\Exception $exception) {
            dd($exception);
            logger()->error($exception);
            return redirect('backend/message')->with('error', Lang::get('messages.wrong'));
        }
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
            $data = $this->model->show($id);//
            return view('backend.message.show',
                compact('data'));
        } catch (\Exception $exception) {
            dd($exception);
            logger()->error($exception);
            return redirect('backend/message')->with('error', Lang::get('messages.wrong'));
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
        try {
            $pages = $this->model->show($id);


            return view('backend.message.edit', compact('pages'));
        } catch (\Exception $exception) {
            dd($exception);
            logger()->error($exception);
            return redirect('backend/message')->with('error', Lang::get('messages.wrong'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(PageRequest $request, $id)
    {
        try {
            $data['title'] = $request->title;
            $data['homedescription'] = $request->homedescription;
            $data['description'] = $request->description;
            $this->model->update($data, $id);


            $rules = $request->file('rules');
            $orders = $request->file('orders_of_decrees_presidential');
            $gov_dec = $request->file('government_decisions');
            $health_orders = $request->file('health_care_orders');
            $norms = $request->file('sanitary_rules_and_norms');
            $destinationPath = public_path('documents');

            // TODO grel insertnery kam updatenery


          if(!empty($rules)){
                for($i = 0;$i <= count($rules)-1; $i++){
                    $rules[$i]->move($destinationPath,$rules[$i]->getClientOriginalName());
                }
            }
            if(!empty($orders)){
                for($i = 0;$i <= count($orders)-1; $i++){
                    $orders[$i]->move($destinationPath,$orders[$i]->getClientOriginalName());
                }
            }
            if(!empty($gov_dec)){
                for($i = 0;$i <= count($gov_dec)-1; $i++){
                    $gov_dec[$i]->move($destinationPath,$gov_dec[$i]->getClientOriginalName());
                }
            }
            if(!empty($health_orders)){
                for($i = 0;$i <= count($health_orders)-1; $i++){
                    $health_orders[$i]->move($destinationPath,$health_orders[$i]->getClientOriginalName());
                }
            }
            if(!empty($norms)){
                for($i = 0;$i <= count($norms)-1; $i++){
                    $norms[$i]->move($destinationPath,$norms[$i]->getClientOriginalName());
                }
            }

            return redirect('backend/pages')->with('success', Lang::get('messages.success'));
        } catch (\Exception $exception) {

            logger()->error($exception);
            return redirect('backend/pages')->with('error', Lang::get('messages.wrong'));
        }
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
}
