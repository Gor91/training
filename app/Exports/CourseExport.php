<?php

namespace App\Exports;

use App\Models\Courses;
use App\Repositories\Repository;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;


class CourseExport implements FromCollection, WithHeadings, ShouldAutoSize, WithMapping
{
    /** @var $model Courses */
    protected $model;

    public function __construct()
    {
        // set the model
        $type = new Courses();
        $this->model = new Repository($type);
    }

    public function collection()
    {
        return $this->model->all();
    }

    /**
     * @param mixed $model
     * @return array
     */
    public function map($model): array
    {
        return $this->model->getModel()->exportData($model);
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return $this->model->getModel()->headings();
    }
}
