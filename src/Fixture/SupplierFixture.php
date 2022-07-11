<?php

namespace App\Fixture;


use App\Entity\SupplierInterface;
use Doctrine\ORM\EntityManagerInterface;
use Faker\Generator;
use Sylius\Bundle\FixturesBundle\Fixture\AbstractFixture;
use Sylius\Bundle\FixturesBundle\Fixture\FixtureInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

class SupplierFixture extends AbstractFixture implements FixtureInterface
{
    /** @var FactoryInterface */
    private FactoryInterface $supplierFactory;

    /** @var EntityManagerInterface */
    private EntityManagerInterface $supplierManager;

    /** @var Generator */
    private Generator $generator;


    public function __construct(FactoryInterface $supplierFactory, EntityManagerInterface $supplierManager, Generator $generator)
    {
        $this->supplierFactory = $supplierFactory;
        $this->supplierManager = $supplierManager;
        $this->generator = $generator;
    }

    public function getName(): string
    {
        return 'supplier';
    }

    public function load(array $options): void
    {
        for ($i = 0; $i < $options['count']; $i++){

            /** @var SupplierInterface $supplier */
            $supplier = $this->supplierFactory->createNew();
            $supplier->setEmail($this->generator->companyEmail);
            $supplier->setName($this->generator->company);
            $this->supplierManager->persist($supplier);

        }

        $this->supplierManager->flush();
    }

    protected function configureOptionsNode(ArrayNodeDefinition $optionsNode): void
    {
        $optionsNode
            ->children()
            ->integerNode('count')
        ;
    }


}
