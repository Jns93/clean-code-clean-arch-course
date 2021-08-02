<?php

namespace App\Entities;

use app\Entities\Order;
use app\Entities\DiscountCoupon;

class PlaceOrder
{
    public $coupon;
    public $orders;

    public function __construct()
    {
        $this->coupon = new DiscountCoupon("VALE20", 20);
        $this->orders = [];
    }

    public function execute($input)
    {
        $order = new Order($input['cpf']);
        foreach($input['items'] as $item) {
            $order->addItem($item['description'], $item['price'], $item['quantity']);
        }
        if($input['coupon']) {
            if ($input['coupon'] == $this->coupon->code) {
                $order->addDiscountCoupon($this->coupon);
            }
        }
        $total = $order->getTotal();
        array_push($this->orders, $order);
        return $total;
    }

}
