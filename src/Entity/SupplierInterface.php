<?php

namespace App\Entity;


use Sylius\Component\Resource\Model\ResourceInterface;

interface SupplierInterface extends ResourceInterface
{

    /**
     * @return ?string
     */
    public function getName(): ?string;

    /**
     * @param ?string $name
     */
    public function setName(?string $name): void;

    /**
     * @return ?string
     */
    public function getEmail(): ?string;

    /**
     * @param ?string $email
     */
    public function setEmail(?string $email): void;
}
