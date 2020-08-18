<?php
/**
 * Created by PhpStorm.
 * User: Gtech-pc
 * Date: 06.08.2020
 * Time: 15:19
 */

namespace App\Services;


use App\Models\Message;
use App\Repositories\Repository;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class MessageService
{
    /**
     * @var Repository
     */
    protected $model;


    /**
     * MessageService constructor.
     * @param Message $message
     */
    public function __construct(Message $message)
    {
        $this->model = new Repository($message);
    }


    /**
     * @return Repository[]|\Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {

        $messages = $this->model->all();

        if (!$messages)
            throw new ModelNotFoundException('User not found by ID ');
        return $messages;

    }

    /**
     * @param $request
     * @return mixed
     */
    public function store($request)
    {
        $data = [];
        $data['name'] = $request->name;
        $data['key'] = $request->key;
        $data['value'] = $request->value;
        $inserted = $this->model->create($data);

        if (!$inserted->id)
            throw new ModelNotFoundException('insert chi eghel ');
        return $inserted->id;

    }

    /**
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        $message = $this->model->show($id);
        if (!$message->id)
            throw new ModelNotFoundException('show chi eghel ');
        return $message;
    }

    /**
     * @param $request
     * @param $id
     * @return mixed
     */
    public function update($request, $id)
    {
        $data['name'] = $request->name;
        $data['key'] = $request->key;
        $data['value'] = $request->value;

        $updated = $this->model->update($data, $id);

        if (!$updated)
            throw new ModelNotFoundException('insert chi eghel ');
        return $request->id;
    }

}
