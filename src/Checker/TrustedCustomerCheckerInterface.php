<?php

namespace App\Checker;

use Sylius\Component\Core\Model\CustomerInterface;

interface TrustedCustomerCheckerInterface
{
    public function check(CustomerInterface $customer): bool;
}
