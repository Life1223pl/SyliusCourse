<?php

namespace App\Assigner;

use App\Provider\ShipmentCodeProviderInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Sylius\Component\Core\Model\ShipmentInterface;
use Doctrine\ORM\EntityManagerInterface;

class ShipmentCodeAssigner implements ShipmentCodeAssignerInterface
{
    /** @var ShipmentCodeProviderInterface */
    private $shipmentCodeProvider;

    /** @var EntityManagerInterface */
    private $shipmentManager;

    /**
     * @param ShipmentCodeProviderInterface $shipmentCodeProvider
     * @param ObjectManager $shipmentManager
     */
    public function __construct(ShipmentCodeProviderInterface $shipmentCodeProvider, EntityManagerInterface $shipmentManager)
    {
        $this->shipmentCodeProvider = $shipmentCodeProvider;
        $this->shipmentManager = $shipmentManager;
    }


    public function assign(ShipmentInterface $shipment): void
    {
        if ($shipment->getState() !== ShipmentInterface::STATE_SHIPPED){
            return;
        }

        $shipment->setTracking($this->shipmentCodeProvider->provide($shipment));
        $this->shipmentManager->flush();
    }
}
