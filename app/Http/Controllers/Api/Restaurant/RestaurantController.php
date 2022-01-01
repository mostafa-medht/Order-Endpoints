<?php

namespace App\Http\Controllers\Api\Restaurant;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use App\Repositories\RestaurantRepositoryInterface;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    use GeneralTrait;

    private $restuarantRepository;

    public function __construct(RestaurantRepositoryInterface $restuarantRepository)
    {
        $this->restuarantRepository = $restuarantRepository;
    }

    public function index(Request $request)
    {
        return $this->restuarantRepository->all($request);
    }

    public function store(Request $request)
    {
        return $this->restuarantRepository->store($request);
    }

    public function show(Request $request)
    {
        return $this->restuarantRepository->findById($request);
    }

    public function update($orderId)
    {
        return $this->restuarantRepository->update($orderId);
    }

    public function destroy($orderId)
    {
        return $this->restuarantRepository->delete($orderId);
    }
}
