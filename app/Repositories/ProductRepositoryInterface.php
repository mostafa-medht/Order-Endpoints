<?php

namespace App\Repositories;

interface ProductRepositoryInterface
{
    public function all($request);

    public function store($request);

    public function findById($request);

    public function update($request);

    public function delete($request);
}
