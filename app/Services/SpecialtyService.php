<?php
/**
 * Created by PhpStorm.
 * User: Gtech-pc
 * Date: 06.08.2020
 * Time: 15:19
 */

namespace App\Services;


use App\Models\SpecialtiesType;
use App\Models\Specialty;
use App\Repositories\Repository;
use Illuminate\Database\Eloquent\ModelNotFoundException;


/**
 * Class SpecialtyService
 * @package App\Services
 */
class SpecialtyService
{
    protected $model;

    public function __construct(Specialty $specialty)
    {
        $this->model = new Repository($specialty);
    }


    public function getParentSpecialties()
    {

        $specialties = $this->model->with([
            'specialty' => function ($query) {
                $query->select(['id', 'parent_id', 'type_id', 'name']);
            },
            'specialty.type' => function ($query) {
                $query->select(['id', 'name']);

            }])->whereNull('parent_id')->get();

        if (!$specialties)
            throw new ModelNotFoundException('User not found by ID ');
        return $specialties;

    }

    public function getSpecialtiesType()
    {

        $types = SpecialtiesType::pluck('name', 'id');
        if (!$types)
            throw new ModelNotFoundException('User not found by ID ');
        return $types;

    }

    public function getSpecialties($id)
    {

        $specialties = $this->model->with([
            'specialty' => function ($query) {
                $query->select(['id', 'parent_id', 'type_id', 'name']);
            },
            'specialty.type' => function ($query) {
                $query->select(['id', 'name']);
            }])
            ->where('id', $id)->get();

        if (!$specialties)
            throw new ModelNotFoundException('User not found by ID ');
        return $specialties;

    }

    public function store($request)
    {
        $data = [];
        $data['type_id'] = $request->type_id;
        $data['parent_id'] = $request->parent_id;
        $data['name'] = $request->name;
        $data['icon'] = $request->icon;
        $inserted = $this->model->create($data);

        if(!$inserted->id)
            throw new ModelNotFoundException('insert chi eghel ');
        return $inserted->id;

    }

    public function updateSpecialty($request){
        $data['name'] = $request->name;
        $updated = $this->model->update($data, $request->id);
        if(!$updated)
            throw new ModelNotFoundException('insert chi eghel ');
        return $request->id;
    }

}
