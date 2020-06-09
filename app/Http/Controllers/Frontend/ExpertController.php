<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Education;
use App\Models\Specialties;
use Illuminate\Http\Request;

class ExpertController extends Controller
{
    public function getEducation()
    {
        try {
            $edu = Education::pluck('name','id');
            return response()->json(['edu' => $edu]);
        } catch (\Exception $exception) {
            dd($exception);
            logger()->error($exception);
//            return redirect('backend/dashboard')->with('error', Lang::get('messages.wrong'));
        }
    }
    public function getSpecialty()
    {
        try {
            $spec = [];
            $_spec = Specialties::whereNull('parent_id')->pluck('name','id');
            foreach ($_spec as $index => $item) {
                //todo if Specialties is empty
//                $spec[$index] = $item;
                $s = Specialties::where('parent_id',$index )->pluck('name','id');
                foreach ($s as $key => $value) {
                    $spec[$item][$key] = $value;
                }
            }
//
            return response()->json(['spec' => $spec]);
        } catch (\Exception $exception) {
            dd($exception);
            logger()->error($exception);
//            return redirect('backend/dashboard')->with('error', Lang::get('messages.wrong'));
        }
    }
}
