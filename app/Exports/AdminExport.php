<?php

namespace App\Exports;

use App\Models\Admin;
use App\Repositories\Repository;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;


class AdminExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    protected $model;

    public function __construct()
    {
        // set the model
        $admin = new Admin();
        $this->model = new Repository($admin);
    }

    public function collection()
    {

        return $this->model->all();
    }

    public function headings(): array
    {
        return [
            '#',
            'Name',
            'Email',
            'Email verification',
            'Created at',
            'Updated at'
        ];
    }
}
