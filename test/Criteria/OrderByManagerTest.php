<?php

namespace ApiSkeletonsTest\Doctrine\Criteria;

use Doctrine\Common\Criteria\ArrayCollection;
use Doctrine\Common\Util\ClassUtils;
use Doctrine\ORM\Mapping\ClassMetadata;
use ApiSkeletons\Doctrine\Criteria\Builder;
use DbTest\Entity\Test;
use ApiSkeletons\Doctrine\Criteria\OrderBy\Service\OrderByManager;
use DateTime;

class OrderByManagerTest extends AbstractTest
{
    public function testGetOrderByManager()
    {
        $container = $this->getApplication()->getServiceManager();
        $orderByManager = $container->get(OrderByManager::class);

        $eq = $orderByManager->get('field', [$orderByManager]);

        $this->assertEquals($eq->getOrderByManager(), $orderByManager);
    }

    public function testInvalidOrderByType()
    {
        $this->expectException(\RuntimeException::class);

        $container = $this->getApplication()->getServiceManager();
        $builder = $container->get(Builder::class);
        $objectManager = $container->get('doctrine.entitymanager.orm_default');
        $collection = $this->provideCollection();

        $orderByArray = [
            [
#                'type' => 'eq',
                'field' => 'testFloat',
                'direction' => 'asc',
            ],
        ];

        $builder = $container->get(Builder::class);
        $entityClassName = ClassUtils::getRealClass(get_class($collection->first()));
        $metadata = $objectManager->getClassMetadata($entityClassName);
        $criteria = $builder->create($metadata, [], $orderByArray);
    }

    public function testInvalidOrderByDirection()
    {
        $this->expectException(\RuntimeException::class);

        $container = $this->getApplication()->getServiceManager();
        $builder = $container->get(Builder::class);
        $objectManager = $container->get('doctrine.entitymanager.orm_default');
        $collection = $this->provideCollection();

        $orderByArray = [
            [
                'type' => 'field',
                'field' => 'testFloat',
                'direction' => 'ascending',
            ],
        ];

        $builder = $container->get(Builder::class);
        $entityClassName = ClassUtils::getRealClass(get_class($collection->first()));
        $metadata = $objectManager->getClassMetadata($entityClassName);
        $criteria = $builder->create($metadata, [], $orderByArray);
    }
}
