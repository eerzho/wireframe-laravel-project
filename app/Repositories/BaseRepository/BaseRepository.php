<?php

namespace App\Repositories\BaseRepository;

use Illuminate\Database\Eloquent\Builder;

abstract class BaseRepository
{
    /**
     * @return string
     */
    abstract public function getModel(): string;

    public $model;

    public function __construct()
    {
        $this->model = app($this->getModel());
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function startQuery()
    {
        return $this->model::query();
    }

    /**
     * @param int $id
     *
     * @return Builder|\Illuminate\Database\Eloquent\Model
     */
    public function getById(int $id)
    {
        return $this->startQuery()->ofId($id)->firstOrFail();
    }

    /**
     * @param array $ids
     *
     * @return Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getByIds(array $ids)
    {
        return $this->startQuery()->ofId($ids)->get();
    }
}
