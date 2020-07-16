<?php


namespace App\Http\Traits;


use App\Models\Region;
use App\Repositories\Repository;

trait Address
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    static function getRegions()
    {
        try {
            $region = Region::whereNull('region_id')->pluck('name', 'id');
            return response()->json(['regions' => $region]);
        } catch (\Exception $exception) {
            dd($exception);
            logger()->error($exception);
        }
    }

    static function getTerritories($id)
    {
        try {
// todo create repositories function
            $territories = Region::select(['id', 'name', 'region_id'])
                ->with(['residence' => function ($query) {
                    $query->select(['id', 'name', 'region_id']);
                }])
                ->where('region_id', $id)
                ->get();
            return response()->json(['territories' => $territories]);
        } catch (\Exception $exception) {
            dd($exception);
            logger()->error($exception);
//            return redirect('backend/dashboard')->with('error', Lang::get('messages.wrong'));
        }
    }

    public function getVillages($id)
    {
        try {
            $villages = $this->model->where([['region_id', '=', $id],
                ['status', '=', 'village']],
                ['name', 'id']);
            if (!empty($villages))
                $villages = $this->model->where([['id', '=', $id],
                    ['status', '=', 'territory']],
                    ['name', 'id']);
            return response()->json(['villages' => $villages]);
        } catch (\Exception $exception) {
            dd($exception);
            logger()->error($exception);
//            return redirect('backend/dashboard')->with('error', Lang::get('messages.wrong'));
        }
    }
}