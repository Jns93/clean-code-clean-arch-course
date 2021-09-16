<?php

namespace App\Application;

use App\Domain\Entity\Order;
use app\Domain\Entity\DiscountCoupon;
use app\Entities\Item;
use App\Domain\Service\FreightCalculator;
use App\Application\PlaceOrderInput;
use App\Application\PlaceOrderOutput;
use App\Domain\Repository\ItemRepository;
use App\Domain\Repository\OrderRepository;
use App\Infra\Gateway\Memory\ZipcodeCalculatorAPIMemory;
use App\Domain\Repository\CouponRepository;
use Exception;

class PlaceOrder
{
    public $zipcodeCalculator;
    public $itemRepository;
    public $couponRepository;
    public $orderRepository;

    public function __construct(ItemRepository $itemRepository, CouponRepository $couponRepository, OrderRepository $orderRepository, ZipcodeCalculatorAPIMemory $zipcodeCalculator)
    {
        // $this->coupons = [
        //     new DiscountCoupon("VALE20", 20, '2200/01/01 00:00:00'),
        //     new DiscountCoupon("VALE20_EXPIRED", 20, '1900/01/01 00:00:00')
        // ];
        // $this->items = [
        //     new Item(1, 'Guitarra', 1000, 100, 50, 15, 3),
        //     new Item(2, 'Amplificador', 5000, 50, 50, 50, 22),
        //     new Item(3, 'Cabo', 30, 10, 10, 10, 1)
        // ];
        // $this->orders = [];
        $this->zipcodeCalculator = $zipcodeCalculator;
        $this->itemRepository = $itemRepository;
        $this->couponRepository = $couponRepository;
        $this->orderRepository = $orderRepository;
    }

    public function execute(PlaceOrderInput $input)
    {
        $sequence = $this->orderRepository->count() + 1;
        $order = new Order($input->cpf, $input->issueDate, $sequence);
        $distance = $this->zipcodeCalculator->calculate($input->zipcode, "99.999-999");
        foreach($input->items as $orderItem) {
            // $item = $this->items[$this->findByCode($orderItem['code'])];    --A interface abaixo substitui essa implementação. (Strategy + dependency Inversion)
            $item = $this->itemRepository->getById($orderItem['code']);
            if (!$item) throw new Exception("Item not found");
            //O preço do item não pode vir do DTO. Se não alguem pode definir um preço pelo carrinho.
            //O code e quantidade vem do DTO.
            //O Preço está vindo da camada de persistencia (banco de dados)
            $order->addItem($orderItem['code'], $item->price, $orderItem['quantity']);
            $order->freight += FreightCalculator::calculate($distance, $item) * $orderItem['quantity'];
        }
        if($input->coupon) {
            // foreach($this->coupons as $coupon){
            $coupon = $this->couponRepository->getByCode($input->coupon);
            // if ($input->coupon == $coupon->code) {
                if ($coupon) $order->addDiscountCoupon($coupon);
        }
            // }
        // }
        // array_push($this->orders, $order);
        $this->orderRepository->save($order);
        $total = $order->getTotal();
        $freight = $order->freight;
        $code = $order->code->value;
        return new PlaceOrderOutput($code, $freight, $total);
    }

    // private function findByCode($code)
    // {
    //     foreach ($this->items as $key => $value) {
    //         if ($value->code == $code) {
    //             return $key;
    //         }
    //     }
    //     return null;
    // }               -> Esse metodo foi extraido para ItemRepositoryMemory

}
