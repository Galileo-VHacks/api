<?php

namespace Api\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class EloquentRepository
{
    /**
     * The Model.
     *
     * @var Model
     */
    protected $model;

    /**
     * Find resource by id.
     *
     * @param $id
     *
     * @return mixed
     */
    public function findById($id)
    {
        return $this->model->find($id);
    }

    /**
     * Find where.
     *
     * @param $attributes
     *
     * @return mixed
     */
    public function findWhere($attributes)
    {
        return $this->model->where($attributes);
    }

    /**
     * Start a custom query.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return $this->model->query();
    }
}
