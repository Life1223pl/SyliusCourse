<?php

namespace App\Provider;

use Sylius\Component\Core\Model\ShipmentInterface;

interface ShipmentCodeProviderInterface
{
    public function provide(ShipmentInterface $shipment): string;
}
