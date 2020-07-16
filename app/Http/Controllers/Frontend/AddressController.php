<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Traits\Address;
use App\Models\Region;
use App\Repositories\Repository;

class AddressController extends Controller
{
    use Address;
//    // space that we can use the repository from
//    protected $model;
//
//    public function __construct(Region $region)
//    {
//        // set the model
//        $this->model = new Repository($region);
//    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->getRegions();
    }

    public function territories($id)
    {
        return $this->getTerritories($id);
    }

    public function villages($id)
    {
        return $this->getVillages($id);
    }

}
