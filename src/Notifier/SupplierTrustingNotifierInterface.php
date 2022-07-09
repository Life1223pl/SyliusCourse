<?php

namespace App\Notifier;

use App\Entity\SupplierInterface;

interface SupplierTrustingNotifierInterface
{
    public function notify(SupplierInterface $supplier): void;

}
