<?php namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class Repository implements RepositoryInterface
{
    // model property on class instances
    protected $model;

    // Constructor to bind model to repo
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    // Get all instances of model
    public function all()
    {
        return $this->model->all();
    }

    // create a new record in the database
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    // update record in the database
    public function update(array $data, $id)
    {

        $record = $this->model->find($id);

        return $record->update($data);
    }

    // remove record from the database
    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    // show the record with the given id
    public function show($id)
    {
        try {
            return $this->model->findOrFail($id);
        } catch (\Exception $exception) {
            dd($exception);
        }
    }

    // Get the associated model
    public function getModel()
    {
        return $this->model;
    }

    // Set the associated model
    public function setModel($model)
    {
        $this->model = $model;
        return $this;
    }

    // Eager load database relationships
    public function with($relations)
    {
        return $this->model->with($relations);
    }

    public function where($closure, array $pluck = null)
    {
        return (!empty($pluck)) ?
            $this->model
                ->where($closure)
                ->pluck($pluck[0], $pluck[1]) :
            $this->model
                ->where($closure)->get();

    }

    public function whereNull($data, array $pluck = null)
    {
        return (!empty($pluck))
            ?
            $this->model->whereNull($data)->pluck($pluck[0], $pluck[1])
            :
            $this->model->whereNull($data)->get();
    }
}