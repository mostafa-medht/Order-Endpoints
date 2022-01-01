<?php

namespace App\Repositories;

interface OrderRepositoryInterface
{
    public function all($request);

    public function listAcceptedAndRejected($request);

    public function submit($request);

    public function updateOrderStatus($request);

    public function findById($request);

    public function update($request);

    public function delete($request);
}
