<?php
/**
 * Created by PhpStorm.
 * User: Gtech-pc
 * Date: 06.08.2020
 * Time: 15:19
 */

namespace App\Services;


use App\Models\Specialties;
use App\Models\SpecialtiesType;
use App\Repositories\Repository;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class TypeService
{
    /**
     * @var Repository
     */
    protected $model;

    /**
     * TypeService constructor.
     * @param SpecialtiesType $type
     */
    public function __construct(SpecialtiesType $type)
    {
        $this->model = new Repository($type);
    }


    public function getSpecialties()
    {

        $specialties = $this->model->all();

        if (!$specialties)
            throw new ModelNotFoundException('User not found by ID ');
        return $specialties;

    }


    public function store($request)
    {
        $data = [];
        $data['name'] = $request->name;
        $data['icon'] = $request->icon;
        $data['description'] = $request->description;
        $inserted = $this->model->create($data);

        if (!$inserted->id)
            throw new ModelNotFoundException('insert chi eghel ');
        return $inserted->id;

    }

    public function show($id)
    {
        $type = $this->model->show($id);
        if (!$type->id)
            throw new ModelNotFoundException('show chi eghel ');
        return $type;
    }

    public function update($request, $id)
    {
        $data['name'] = $request->name;
        $data['icon'] = $request->icon;
        $data['description'] = $request->description;

        $updated = $this->model->update($data, $id);

        if (!$updated)
            throw new ModelNotFoundException('insert chi eghel ');
        return $request->id;
    }

    public function destroy($id)
    {
        $remove = $this->model->delete($id);;
        if (!$remove)
            throw new ModelNotFoundException('
            remove chi eghel ');
        return $remove;
    }

    public function typeCheck($request)
    {
        $specialties = Specialties::where('type_id', $request->id)->first();
        if (!$specialties)
            throw new ModelNotFoundException('
            remove chi eghel ');
        return $specialties;
    }
}
