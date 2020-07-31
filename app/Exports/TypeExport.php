<?php

namespace App\Exports;


use App\Models\SpecialtiesType;
use App\Repositories\Repository;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;


class TypeExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    protected $model;

    public function __construct()
    {
        // set the model
        $type = new SpecialtiesType();
        $this->model = new Repository($type);
    }

    public function collection()
    {

        return $this->model->all();
    }

    public function headings(): array
    {
        return [
            '#',
            __('messages.name'),
            __('messages.image_name'),
            __('messages.description'),
            __('messages.created_at'),
            __('messages.updated_at'),

        ];
    }
}
