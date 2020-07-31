<?php

namespace App\Exports;

use App\Models\Account;
use App\Repositories\Repository;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;


class AccountExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    protected $model;
    protected $role;

    public function __construct($role)
    {
        // set the model

        $this->role = $role;
        $account = new Account();
        $this->model = new Repository($account);
    }

    public function collection()
    {
        $accounts = $this->model->with([
            'user' => function ($query) {
                $query->select(['email', 'account_id']);
            },
            'prof' => function ($query) {
                $query->select(['account_id', 'profession']);
            }])->where('role', $this->role)->get();
        foreach ($accounts as $index => $account) {

            $home_address = json_decode($account->home_address, true);
            $h = getRegionName($home_address['h_region']);
            $h .= " " . getRegionName($home_address['h_territory']);
            $h .= " " . $home_address['h_street'];
            $account->home_address = $h;
            $work_address = json_decode($account->work_address, true);
            $w = getRegionName($work_address['w_region']);
            $w .= " " . getRegionName($work_address['w_territory']);
            $w .= " " . $work_address['w_street'];
            $account->work_address = $w;
            unset($account->role);
            unset($account->image_name);
            unset($account->created_at);
            unset($account->updated_at);
            $prof = getProfession($account->id);

            $account['education'] =  $prof->edu_name . " - " . $prof->spec_name;
            $account['email'] = $account->user->email;
        }

        return $accounts;
    }

    public function headings(): array
    {
        return [
            '#',
            __('messages.name'),
            __('messages.surname'),
            __('messages.father_name'),
            __('messages.bday'),
            __('messages.phone'),
            __('messages.passport'),
            __('messages.date_of_issue'),
            __('messages.date_of_expiry'),
            __('messages.work_address'),
            __('messages.home_address'),
            __('messages.workplace_name'),
            __('messages.education'),
            __('messages.email'),
        ];
    }
}
