<?php

namespace App\ShippingCalculator;

use Sylius\Component\Core\Model\OrderItemInterface;
use Sylius\Component\Shipping\Calculator\CalculatorInterface;
use Sylius\Component\Shipping\Model\ShipmentInterface;

class WeightBasedShippingCalculator implements CalculatorInterface
{

    public function calculate(ShipmentInterface $subject, array $configuration): int
    {
        $totalWeight = 0.0;

        /** @var OrderItemInterface $iteam */
        foreach ($subject->getOrder()->getIteams() as $iteam){
            //wez wagę z każdego przedmiotu w zamówieniu i pomnóż przez ilość danego przedmiotu, dodaj wszystkie wagi do siebie.
            $totalWeight += $iteam->getVariant()->getWeight() * $iteam->getQuantity();
        }
        if($totalWeight >= $configuration['weight']){
            return $configuration['above_or_equal'];
        }

        return $configuration['below'];
    }

    public function getType(): string
    {
        return 'weight_based';
    }
}
