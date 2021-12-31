<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Traits\GeneralTrait;

class RestaurantController extends Controller
{
    use GeneralTrait;

    public function index()
    {
        $restaurants = Restaurant::get();
        return $this->returnData("restaurants", $restaurants);
    }

    public function show(Request $request)
    {
        $restaurant = Restaurant::find($request->id);
        if (!$restaurant)
            return $this->returnError("", "Restaurant Not Found");
        return $this->returnData("restaurant", $restaurant);
    }
}
