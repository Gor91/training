<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Spatie\PdfToImage\Pdf;

class MakeImagesFromPDFJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $pdf;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($book)
    {
        $this->pdf = $book;
    }

    /**
     * @throws \Spatie\PdfToImage\Exceptions\PageDoesNotExist
     * @throws \Spatie\PdfToImage\Exceptions\PdfDoesNotExist
     */
    public function handle()
    {
        $path = public_path() . Config::get('constants.UPLOADS') . "/books/" . $this->pdf->id.'/';
        $pathToImage = $path . $this->pdf->path;

        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0775, true, true);
        }

        if (file_exists($pathToImage)) {
            $pdf = new Pdf($pathToImage);

            foreach (range(1, $pdf->getNumberOfPages()) as $pageNumber) {
                $pdf->setPage($pageNumber)->saveImage($path . '/' . $pageNumber . '.jpg');
            }
        }
    }
}
