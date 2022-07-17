<?php

namespace App\Checker;

use Sylius\Component\Core\Model\CustomerInterface;

class TrustedCustomerChecker implements TrustedCustomerCheckerInterface
{

    public function check(CustomerInterface $customer): bool
    {
        if ($customer->getGroup() === null){
            return false;
        }

        if($customer->getGroup()->getCode() !== 'TRUSTED'){
            return false;
        }

        return true;
    }
}
