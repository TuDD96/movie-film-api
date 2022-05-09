<?php

declare(strict_types=1);

namespace App\Repositories;

interface EloquentRepositoryInterface 
{
    /**
     * Get all
     * @return mixed
     */
    public function all();

    /**
     * Get one
     * @param $id
     * @param  null  $attributes
     * @return mixed
     */
    public function find($id, $attributes = null);

    /**
     * Delete
     *
     * @param $id
     * @return bool
     */
    public function delete($id);

    /**
     * Create
     *
     * @param $id
     * @return bool
     */
    public function create($attribute);

    /**
     * Insert
     *
     * @param $array
     * @return bool
     */
    public function insert($array);

    public function insertGetId($data = []);

    /**
     * Update
     * @param $id, $attribute
     * @return bool
     */
    public function update($id, $attribute);

    /**
     * Update by condition
     * @param $conditions, $data
     * @return bool
     */
    public function updateByCondition($conditions, $data);
}
