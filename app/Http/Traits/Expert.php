<?php


namespace App\Http\Traits;


use App\Models\SpecialtiesType;
use App\Models\Specialty;

trait Expert
{

    static function getEducation($id)
    {
        try {
            $edu = Specialty::select('id', 'name')->where('parent_id', $id)
                ->get();

            return response()->json(['edu' => $edu]);
        } catch (\Exception $exception) {
            dd($exception);
            logger()->error($exception);
//            return redirect('backend/dashboard')->with('error', Lang::get('messages.wrong'));
        }
    }
//todo jnjel stugel
    static function getEducate($id)
    {

        try {
            $edu = Specialty::select('id', 'name')->where('id', $id)->first();
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
            $spec = Specialty::select('id', 'name')->where('type_id', $id)
                ->whereNull('parent_id')
                ->get();

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
            $prof = SpecialtiesType::select('name', 'id')->get();

            return response()->json(['prof' => $prof]);
        } catch (\Exception $exception) {
            dd($exception);
            logger()->error($exception);
//            return redirect('backend/dashboard')->with('error', Lang::get('messages.wrong'));
        }
    }
}
