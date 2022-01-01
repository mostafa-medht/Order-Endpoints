<?php

namespace App\Http\Controllers\Api\Order;

use App\Http\Controllers\Controller;
use App\Repositories\OrderRepositoryInterface;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    use GeneralTrait;

    private $orderRepository;

    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function index(Request $request)
    {
        // $orders = $this->orderRepository->all();
        return $this->orderRepository->all($request);
    }

    public function submit(Request $request)
    {
        return $this->orderRepository->submit($request);
    }

    public function show(Request $request)
    {
        $order = $this->orderRepository->findById($request);
        return $order;
    }

    public function update($orderId)
    {
        $this->orderRepository->update($orderId);

        return redirect('/customers/' . $orderId);
    }

    public function destroy($orderId)
    {
        $this->orderRepository->delete($orderId);

        return redirect('/orders');
    }
}