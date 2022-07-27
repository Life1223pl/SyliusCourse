<?php

namespace App\Promotion\Action;

use Sylius\Component\Core\Model\AdjustmentInterface;
use Sylius\Component\Core\Model\OrderInterface;
use Sylius\Component\Order\Factory\AdjustmentFactoryInterface;
use Sylius\Component\Promotion\Action\PromotionActionCommandInterface;
use Sylius\Component\Promotion\Model\PromotionInterface;
use Sylius\Component\Promotion\Model\PromotionSubjectInterface;

class FreeOrderPromotionActionCommand implements PromotionActionCommandInterface
{
    /** @var AdjustmentFactoryInterface */
    private $adjustmentFactory;

    /**
     * @param AdjustmentFactoryInterface $adjustmentFactory
     */
    public function __construct(AdjustmentFactoryInterface $adjustmentFactory)
    {
        $this->adjustmentFactory = $adjustmentFactory;
    }


    public function execute(PromotionSubjectInterface $subject, array $configuration, PromotionInterface $promotion): bool
    {
        if (!$subject instanceof OrderInterface){
            return false;
        }

        $adjustment = $this->adjustmentFactory->createWithData(
            AdjustmentInterface::ORDER_PROMOTION_ADJUSTMENT,
                 $promotion->getName(),
            -1 * $subject->getTotal()
        );
        $subject->addAdjustment($adjustment);

        return true;
    }

    public function revert(PromotionSubjectInterface $subject, array $configuration, PromotionInterface $promotion): void
    {
        if (!$subject instanceof OrderInterface){
            return;
        }

        foreach ($subject->getAdjustments() as $adjustment){
            if ($adjustment->getLabel() === $promotion->getName()){
                $subject->removeAdjustment($adjustment);
            }
        }
    }
}
