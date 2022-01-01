<?php

namespace App\Repositories;

use App\Models\Product;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\Validator;

class ProductRepository implements ProductRepositoryInterface
{
    use GeneralTrait;

    public function all($request)
    {
        try {
            if (!$this->checkAccessibility()) {
                return $this->returnError("", "Unauthorized");
            }
            $products = Product::get();
            if ($products)
                return $this->returnData("restaurants", $products);
            return $this->returnError("", "There is no result");
        } catch (\Exception $exception) {
            return $this->returnError("", $exception->getMessage());
        }
    }

    public function store($request)
    {
        $validator = $this->validator($request);

        if ($validator->fails()) {
            $code = $this->returnCodeAccordingToInput($validator);
            return $this->returnValidationError($code, $validator);
        }

        try {
            if (!$this->checkAccessibility()) {
                return $this->returnError("", "Unauthorized");
            }
            $product = Product::create($request->all());
            return $this->returnSuccessMessage("", "Product Stored Successfully");
        } catch (\Exception $exception) {
            return $this->returnError("", $exception->getMessage());
        }
    }

    public function findById($request)
    {
        try {
            if (!$this->checkAccessibility()) {
                return $this->returnError("", "Unauthorized");
            }
            $product = Product::find($request->productId);
            if ($product)
                return $this->returnData("product", $product);
            return $this->returnError("", "There is no result");
        } catch (\Exception $exception) {
            return $this->returnError("", $exception->getMessage());
        }
    }

    public function update($request)
    {
        $validator = $this->validator($request);

        if ($validator->fails()) {
            $code = $this->returnCodeAccordingToInput($validator);
            return $this->returnValidationError($code, $validator);
        }

        try {
            if (!$this->checkAccessibility()) {
                return $this->returnError("", "Unauthorized");
            }
            $product = Product::first($request->productId);
            $product->update(request()->all());

            return $this->returnSuccessMessage("", "Product Stored Successfully");
        } catch (\Exception $exception) {
            return $this->returnError("", $exception->getMessage());
        }
    }

    public function delete($request)
    {
        try {
            $product = Product::where('id', $request->productId)->delete();
            return $this->returnSuccessMessage("", "Deleted Successfully");
        } catch (\Exception $exception) {
            return $this->returnError("", $exception->getMessage());
        }
    }

    private function validator($request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required',
            'restaurant_id' => 'required',
        ]);
        return $validator;
    }
}
