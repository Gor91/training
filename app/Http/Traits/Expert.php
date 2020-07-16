<?php


namespace App\Http\Traits;


use App\Models\Education;
use App\Models\SpecialtiesType;
use App\Models\Specialty;

trait Expert
{

    static function getEducation()
    {
        try {
            $edu = Education::
            pluck('name', 'id');
            return response()->json(['edu' => $edu]);
        } catch (\Exception $exception) {
            dd($exception);
            logger()->error($exception);
//            return redirect('backend/dashboard')->with('error', Lang::get('messages.wrong'));
        }
    }

    static function getSpecialty($id)
    {
        try {
            $spec = [];
            $_spec = Specialty::where('type_id', $id)
                ->whereNull('parent_id')
                ->pluck('name', 'id');
            foreach ($_spec as $index => $item) {
                //todo if Specialties is empty
//                $spec[$index] = $item;
                $s = Specialty::where('parent_id', $index)->pluck('name', 'id');
                foreach ($s as $key => $value) {
                    $spec[$item][$key] = $value;
                }
            }

            return response()->json(['spec' => $spec]);
        } catch (\Exception $exception) {
            dd($exception);
            logger()->error($exception);
//            return redirect('backend/dashboard')->with('error', Lang::get('messages.wrong'));
        }
    }

    static function getProfession()
    {
        try {
            $prof = SpecialtiesType::pluck('name', 'id');
            return response()->json(['prof' => $prof]);
        } catch (\Exception $exception) {
            dd($exception);
            logger()->error($exception);
//            return redirect('backend/dashboard')->with('error', Lang::get('messages.wrong'));
        }
    }
}