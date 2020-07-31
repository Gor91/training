<?php namespace App\Repositories;

interface RepositoryInterface
{
    public function all();

    public function selected($data);

    public function create(array $data);

    public function update(array $data, $id);

    public function delete($id);

    public function where(array $data, array $pluck = null);

    public function whereNull($data, array $pluck = null);

    public function show($id);
}