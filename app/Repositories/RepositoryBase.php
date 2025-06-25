<?php

namespace App\Repositories;



/**
 * Class RepositoryBase implements RepositoryInterface
 * @package App\Repositories
 * @template TModel
 */
abstract class RepositoryBase
{
    /**
     * @var TModel
     */
    protected $model;

    /**
     * @return TModel
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param TModel $model
     */
    public function __construct()
    {

    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * @param int $id
     * @return TModel
     */
    public function find(int $id)
    {
        return $this->model->find($id);
    }

    /**
     * @param array $data
     * @return TModel
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update(int $id, array $data)
    {
        return $this->model->where('id', $id)->update($data);
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id)
    {
        return $this->model->where('id', $id)->delete();
    }
}
