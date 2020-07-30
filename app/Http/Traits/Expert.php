<?php


namespace App\Http\Traits;


use App\Models\SpecialtiesType;
use App\Models\Specialty;

trait Expert
{

    static function getEducation($id)
    {
        try {
            $edu = Specialty::where('parent_id', $id)
                ->pluck('name', 'id');

            return response()->json(['edu' => $edu]);
        } catch (\Exception $exception) {
            dd($exception);
            logger()->error($exception);
//            return redirect('backend/dashboard')->with('error', Lang::get('messages.wrong'));
        }
    }

    static function getEducate()
    {
        try {
            $edu = Specialty::whereNull('parent_id')
                ->pluck('name', 'id');

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
//            $spec = [];
            $spec = Specialty::where('type_id', $id)
                ->whereNull('parent_id')
                ->pluck('name', 'id');

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