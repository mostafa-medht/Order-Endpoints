<?php

namespace App\Repositories;

use App\Http\Requests\SubmitOrder;
use Illuminate\Http\Request;

interface OrderRepositoryInterface
{
    public function all($request);

    public function submit($request);

    public function findById($request);

    public function update($request);

    public function delete($request);
}
