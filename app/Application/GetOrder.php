<?php

namespace App\Application;

use App\Domain\Entity\Order;
use app\Domain\Entity\DiscountCoupon;
use app\Entities\Item;
use App\Domain\Service\FreightCalculator;
use App\Application\PlaceOrderInput;
use App\Application\GetOrderOutput;
use App\Domain\Repository\ItemRepository;
use App\Domain\Repository\OrderRepository;
use App\Domain\Repository\CouponRepository;
use Exception;

class GetOrder
{
    public $itemRepository;
    public $couponRepository;
    public $orderRepository;

    public function __construct(ItemRepository $itemRepository, CouponRepository $couponRepository, OrderRepository $orderRepository)
    {
        $this->itemRepository = $itemRepository;
        $this->couponRepository = $couponRepository;
        $this->orderRepository = $orderRepository;
    }

    public function execute($code)
    {
        $order = $this->orderRepository->get($code);
        $orderItems = [];
        foreach($order->items as $key => $value) {
            $item = $this->itemRepository->getById($value->code);
            $orderItemOutput['description'] = $item->description;
            $orderItemOutput['price'] = $item->price;
            $orderItemOutput['quantity'] = $order->items[$key]->quantity;
            array_push($orderItems, $orderItemOutput);
        }
        return new GetOrderOutput($order->code, $order->freight, $order->getTotal(), $orderItems);
    }
}
