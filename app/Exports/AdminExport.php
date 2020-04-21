<?php
namespace App\Exports;
use App\Models\Admin;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class AdminExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    public function collection()
    {
        return Admin::all();
    }
    public function headings(): array
    {
        return [
            '#',
            'Name',
            'Email',
            'Created at',
            'Updated at'
        ];
    }
}