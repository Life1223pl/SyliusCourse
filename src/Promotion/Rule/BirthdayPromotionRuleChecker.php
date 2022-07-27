<?php

namespace App\Promotion\Rule;

use Sylius\Component\Core\Model\OrderInterface;
use Sylius\Component\Promotion\Checker\Rule\RuleCheckerInterface;
use Sylius\Component\Promotion\Model\PromotionSubjectInterface;
use Symfony\Component\Validator\Constraints\Date;

class BirthdayPromotionRuleChecker implements RuleCheckerInterface
{

    public function isEligible(PromotionSubjectInterface $subject, array $configuration): bool
    {
        if (!$subject instanceof OrderInterface){
            return false;
        }

        $birthday = $subject->getCustomer()->getBirthday();
        if($birthday === null){
            return false;
        }

        $today = (new \DateTime())->format('d-m');

        if($birthday->format('d-m') === $today){
            return true;
        }
        return false;
    }
}
