<?php

namespace App\Notifier;

use App\Entity\SupplierInterface;
use Psr\Log\LoggerInterface;

class LogSupplierTrustingNotifier implements SupplierTrustingNotifierInterface
{
    /** @var LoggerInterface */
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function notify(SupplierInterface $supplier): void
    {
        $this->logger->info(sprintf('Supplier "%s" has just been trusted!', $supplier->getName()));
    }
}
