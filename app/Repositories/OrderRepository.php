<?php

namespace App\Repositories;

use App\Events\NewOrderHasSubmitted;
use App\Models\Order;
use App\Services\FirstSMSService;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\Validator;

class OrderRepository implements OrderRepositoryInterface
{
    use GeneralTrait;

    public function all($request)
    {
        try {
            if (!$this->checkAccessibility()) {
                return $this->returnError("", "Unauthorized");
            }
            $orders = Order::with('products', 'user', 'restaurant')->get();
            if ($orders)
                return $this->returnData("orders", $orders);
            return $this->returnError("", "There is no result");
        } catch (\Exception $exception) {
            return $this->returnError("", $exception->getMessage());
        }
    }

    public function submit($request)
    {
        $validator = Validator::make($request->all(), [
            'restaurant_id' => 'required',
            'products' => 'required|array',
            'quantities' => 'required|array',
        ]);

        if ($validator->fails()) {
            $code = $this->returnCodeAccordingToInput($validator);
            return $this->returnValidationError($code, $validator);
        }

        try {
            $order = Order::create($request->all());
            $products = $request->input('products', []);
            $quantities = $request->input('quantities', []);
            for ($product = 0; $product < count($products); $product++) {
                if ($products[$product] != '') {
                    $order->products()->attach($products[$product], ['quantity' => $quantities[$product]]);
                }
            }
            event(new NewOrderHasSubmitted($order));
            return $this->returnSuccessMessage("", "Submitted Successfully");
        } catch (\Exception $exception) {
            return $this->returnError("", $exception->getMessage());
        }
    }

    public function findById($request)
    {
        try {
            $order = Order::where('id', $request->orderId)
                ->with('products', 'user', 'restaurant')
                ->first();
            if ($order)
                return $this->returnData("order", $order);
            return $this->returnError("", "There is no result");
        } catch (\Exception $exception) {
            return $this->returnError("", $exception->getMessage());
        }
    }

    public function update($request)
    {
        $orders = Order::where('id', $request->orderId)->delete();
        $orders->update(request()->only('name'));
    }

    public function delete($request)
    {
        $orders = Order::where('id', $request->orderId)->firstOrFail();
    }
}
