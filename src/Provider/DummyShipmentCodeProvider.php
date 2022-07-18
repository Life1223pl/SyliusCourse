<?php

namespace App\Provider;

use Sylius\Component\Core\Model\ShipmentInterface;

class DummyShipmentCodeProvider implements ShipmentCodeProviderInterface
{

    public function provide(ShipmentInterface $shipment): string
    {
        return '123123';
    }
}
