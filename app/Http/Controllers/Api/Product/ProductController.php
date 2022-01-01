<?php

namespace App\Http\Controllers\Api\Product;

use App\Http\Controllers\Controller;
use App\Repositories\ProductRepositoryInterface;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use GeneralTrait;

    private $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index(Request $request)
    {
        return $this->productRepository->all($request);
    }

    public function store(Request $request)
    {
        return $this->productRepository->store($request);
    }

    public function show(Request $request)
    {
        return $this->productRepository->findById($request);
    }

    public function update($request)
    {
        return $this->productRepository->update($request);
    }

    public function destroy($request)
    {
        return $this->productRepository->delete($request);
    }
} // end of controller
