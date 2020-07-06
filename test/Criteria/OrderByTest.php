<?php

namespace ApiSkeletonsTest\Doctrine\Criteria;

use Doctrine\Common\Criteria\ArrayCollection;
use Doctrine\Common\Util\ClassUtils;
use Doctrine\ORM\Mapping\ClassMetadata;
use ApiSkeletons\Doctrine\Criteria\Builder;
use DbTest\Entity\Test;
use ApiSkeletons\Doctrine\Criteria\OrderBy\Service\OrderByManager;
use DateTime;

class OrderByTest extends AbstractTest
{
    public function testSortStringAsc()
    {
        $container = $this->getApplication()->getServiceManager();
        $builder = $container->get(Builder::class);
        $objectManager = $container->get('doctrine.entitymanager.orm_default');
        $collection = $this->provideCollection();

        $orderByArray = [
            [
                'type' => 'field',
                'field' => 'testString',
                'direction' => 'asc',
            ],
        ];

        $builder = $container->get(Builder::class);
        $entityClassName = ClassUtils::getRealClass(get_class($collection->first()));
        $metadata = $objectManager->getClassMetadata($entityClassName);
        $criteria = $builder->create($metadata, [], $orderByArray);

        $filteredCollection = $collection->matching($criteria);

        $this->assertEquals('uvwxy', $filteredCollection->last()->testString);
    }

    public function testSortStringDesc()
    {
        $container = $this->getApplication()->getServiceManager();
        $builder = $container->get(Builder::class);
        $objectManager = $container->get('doctrine.entitymanager.orm_default');
        $collection = $this->provideCollection();

        $orderByArray = [
            [
                'type' => 'field',
                'field' => 'testString',
                'direction' => 'desc',
            ],
        ];

        $builder = $container->get(Builder::class);
        $entityClassName = ClassUtils::getRealClass(get_class($collection->first()));
        $metadata = $objectManager->getClassMetadata($entityClassName);
        $criteria = $builder->create($metadata, [], $orderByArray);

        $filteredCollection = $collection->matching($criteria);

        $this->assertEquals('uvwxy', $filteredCollection->first()->testString);
    }
}
