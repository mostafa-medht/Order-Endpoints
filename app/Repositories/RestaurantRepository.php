<?php

namespace App\Repositories;

use App\Models\Restaurant;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\Validator;

class RestaurantRepository implements RestaurantRepositoryInterface
{
    use GeneralTrait;

    public function all($request)
    {
        try {
            if (!$this->checkAccessibility()) {
                return $this->returnError("", "Unauthorized");
            }
            $restaurants = Restaurant::get();
            if ($restaurants)
                return $this->returnData("restaurants", $restaurants);
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
            $restaurant = Restaurant::create($request->all());
            return $this->returnSuccessMessage("", "Restaurant Stored Successfully");
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
            $restaurant = Restaurant::find($request->restaurantId);
            if ($restaurant)
                return $this->returnData("restaurant", $restaurant);
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
            $restaurant = Restaurant::first($request->restaurantId);
            $restaurant->update(request()->only('name'));

            return $this->returnSuccessMessage("", "Restaurant Stored Successfully");
        } catch (\Exception $exception) {
            return $this->returnError("", $exception->getMessage());
        }
    }

    public function delete($request)
    {
        try {
            $restaurant = Restaurant::where('id', $request->restaurantId)->delete();
            return $this->returnSuccessMessage("", "Deleted Successfully");
        } catch (\Exception $exception) {
            return $this->returnError("", $exception->getMessage());
        }
    }

    private function validator($request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        return $validator;
    }
}
