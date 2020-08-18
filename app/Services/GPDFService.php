<?php


namespace App\Services;


use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;

class GPDFService
{
    public static function gdPDF($page, $load_page, $const, $data)
    {
        $pdf = PDF::loadView($load_page,
            ['data' => $data])->setPaper('a4', 'landscape')->setWarnings(false);

        if (!Storage::exists(Config::get($const))) {
            Storage::makeDirectory(Config::get($const), 0775, true);
        }

        $pdf->save(storage_path() . Config::get('constants.APP') . Config::get($const) . $page);

        $file = storage_path(Config::get('constants.APP') . Config::get($const) . $page);
        if (!$file)
            throw new ModelNotFoundException('file chi steghcvel ');
        return $file;

    }
}
