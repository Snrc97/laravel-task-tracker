<?php

namespace App\Repositories;

use App\Traits\Cacheable;



/**
 * Class RepositoryBase implements RepositoryInterface
 * @package App\Repositories
 * @template TModel
 */
abstract class RepositoryBase
{
    use Cacheable;
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
        return $this->withCache($this->model->getTable(), function ($data) {
            $data ??= $this->model->all();
            return $data;
        });
    }

    /**
     * @param int $id
     * @return TModel
     */
    public function find(int $id)
    {
        return $this->withCache($this->model->getTable().'_'.$id, function ($data) use($id) {
            $data ??= $this->model->find($id);
            return $data;
        });
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
