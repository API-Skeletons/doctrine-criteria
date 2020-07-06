<?php

namespace ApiSkeletonsTest\Doctrine\Criteria;

use Doctrine\Common\Criteria\ArrayCollection;
use Doctrine\Common\Util\ClassUtils;
use Doctrine\ORM\Mapping\ClassMetadata;
use ApiSkeletons\Doctrine\Criteria\Builder;
use DbTest\Entity\Test;
use ApiSkeletons\Doctrine\Criteria\Filter\Service\FilterManager;
use DateTime;

class FilterManagerTest extends AbstractTest
{
    public function testGetFilterManager()
    {
        $container = $this->getApplication()->getServiceManager();
        $filterManager = $container->get(FilterManager::class);

        $eq = $filterManager->get('eq', [$filterManager]);

        $this->assertEquals($eq->getFilterManager(), $filterManager);
    }

    public function testInvalidFilter()
    {
        $this->expectException(\RuntimeException::class);

        $container = $this->getApplication()->getServiceManager();
        $builder = $container->get(Builder::class);
        $objectManager = $container->get('doctrine.entitymanager.orm_default');
        $collection = $this->provideCollection();

        $filterArray = [
            [
#                'type' => 'eq',
                'field' => 'testFloat',
                'value' => 54.321,
            ],
        ];

        $builder = $container->get(Builder::class);
        $entityClassName = ClassUtils::getRealClass(get_class($collection->first()));
        $metadata = $objectManager->getClassMetadata($entityClassName);
        $criteria = $builder->create($metadata, $filterArray, []);
    }
}
