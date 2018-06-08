<?php

namespace ZFTest\Doctrine\Criteria;

use Doctrine\Common\Criteria\ArrayCollection;
use Doctrine\Common\Util\ClassUtils;
use Doctrine\ORM\Mapping\ClassMetadata;
use ZF\Doctrine\Criteria\Builder;
use DbTest\Entity\Test;
use DateTime;

class FilterArrayTest extends AbstractTest
{
    public function testContains()
    {
        $container = $this->getApplication()->getServiceManager();
        $builder = $container->get(Builder::class);
        $objectManager = $container->get('doctrine.entitymanager.orm_default');
        $collection = $this->provideCollection();

        $filterArray = [
            [
                'type' => 'contains',
                'field' => 'testString',
                'value' => 'bcd',
            ],
        ];

        $builder = $container->get(Builder::class);
        $entityClassName = ClassUtils::getRealClass(get_class($collection->first()));
        $metadata = $objectManager->getClassMetadata($entityClassName);
        $criteria = $builder->create($metadata, $filterArray, []);

        $filteredCollection = $collection->matching($criteria);

        $this->assertEquals(1, $filteredCollection->count());
    }

    public function testEndsWith()
    {
        $container = $this->getApplication()->getServiceManager();
        $builder = $container->get(Builder::class);
        $objectManager = $container->get('doctrine.entitymanager.orm_default');
        $collection = $this->provideCollection();

        $filterArray = [
            [
                'type' => 'endswith',
                'field' => 'testString',
                'value' => 'de',
            ],
        ];

        $builder = $container->get(Builder::class);
        $entityClassName = ClassUtils::getRealClass(get_class($collection->first()));
        $metadata = $objectManager->getClassMetadata($entityClassName);
        $criteria = $builder->create($metadata, $filterArray, []);

        $filteredCollection = $collection->matching($criteria);

        $this->assertEquals(1, $filteredCollection->count());
    }

    public function testEquals()
    {
        $container = $this->getApplication()->getServiceManager();
        $builder = $container->get(Builder::class);
        $objectManager = $container->get('doctrine.entitymanager.orm_default');
        $collection = $this->provideCollection();

        $filterArray = [
            [
                'type' => 'eq',
                'field' => 'testInteger',
                'value' => 1000,
            ],
        ];

        $builder = $container->get(Builder::class);
        $entityClassName = ClassUtils::getRealClass(get_class($collection->first()));
        $metadata = $objectManager->getClassMetadata($entityClassName);
        $criteria = $builder->create($metadata, $filterArray, []);

        $filteredCollection = $collection->matching($criteria);

        $this->assertEquals(1, $filteredCollection->count());
    }

    public function testGreaterThan()
    {
        $container = $this->getApplication()->getServiceManager();
        $builder = $container->get(Builder::class);
        $objectManager = $container->get('doctrine.entitymanager.orm_default');
        $collection = $this->provideCollection();

        $filterArray = [
            [
                'type' => 'gt',
                'field' => 'testInteger',
                'value' => 1000,
            ],
        ];

        $builder = $container->get(Builder::class);
        $entityClassName = ClassUtils::getRealClass(get_class($collection->first()));
        $metadata = $objectManager->getClassMetadata($entityClassName);
        $criteria = $builder->create($metadata, $filterArray, []);

        $filteredCollection = $collection->matching($criteria);

        $this->assertEquals(4, $filteredCollection->count());
    }

    public function testGreaterThanOrEquals()
    {
        $container = $this->getApplication()->getServiceManager();
        $builder = $container->get(Builder::class);
        $objectManager = $container->get('doctrine.entitymanager.orm_default');
        $collection = $this->provideCollection();

        $filterArray = [
            [
                'type' => 'gte',
                'field' => 'testInteger',
                'value' => 1000,
            ],
        ];

        $builder = $container->get(Builder::class);
        $entityClassName = ClassUtils::getRealClass(get_class($collection->first()));
        $metadata = $objectManager->getClassMetadata($entityClassName);
        $criteria = $builder->create($metadata, $filterArray, []);

        $filteredCollection = $collection->matching($criteria);

        $this->assertEquals(5, $filteredCollection->count());
    }

    public function testIn()
    {
        $container = $this->getApplication()->getServiceManager();
        $builder = $container->get(Builder::class);
        $objectManager = $container->get('doctrine.entitymanager.orm_default');
        $collection = $this->provideCollection();

        $filterArray = [
            [
                'type' => 'in',
                'field' => 'testInteger',
                'values' => [1000, 2000, 3000],
            ],
        ];

        $builder = $container->get(Builder::class);
        $entityClassName = ClassUtils::getRealClass(get_class($collection->first()));
        $metadata = $objectManager->getClassMetadata($entityClassName);
        $criteria = $builder->create($metadata, $filterArray, []);

        $filteredCollection = $collection->matching($criteria);

        $this->assertEquals(3, $filteredCollection->count());
    }

    public function testLessThan()
    {
        $container = $this->getApplication()->getServiceManager();
        $builder = $container->get(Builder::class);
        $objectManager = $container->get('doctrine.entitymanager.orm_default');
        $collection = $this->provideCollection();

        $filterArray = [
            [
                'type' => 'lt',
                'field' => 'testInteger',
                'value' => 3000,
            ],
        ];

        $builder = $container->get(Builder::class);
        $entityClassName = ClassUtils::getRealClass(get_class($collection->first()));
        $metadata = $objectManager->getClassMetadata($entityClassName);
        $criteria = $builder->create($metadata, $filterArray, []);

        $filteredCollection = $collection->matching($criteria);

        $this->assertEquals(2, $filteredCollection->count());
    }

    public function testLessThanOrEquals()
    {
        $container = $this->getApplication()->getServiceManager();
        $builder = $container->get(Builder::class);
        $objectManager = $container->get('doctrine.entitymanager.orm_default');
        $collection = $this->provideCollection();

        $filterArray = [
            [
                'type' => 'lte',
                'field' => 'testInteger',
                'value' => 3000,
            ],
        ];

        $builder = $container->get(Builder::class);
        $entityClassName = ClassUtils::getRealClass(get_class($collection->first()));
        $metadata = $objectManager->getClassMetadata($entityClassName);
        $criteria = $builder->create($metadata, $filterArray, []);

        $filteredCollection = $collection->matching($criteria);

        $this->assertEquals(3, $filteredCollection->count());
    }

    public function testMemberOf()
    {
        $container = $this->getApplication()->getServiceManager();
        $builder = $container->get(Builder::class);
        $objectManager = $container->get('doctrine.entitymanager.orm_default');
        $collection = $this->provideCollection();

        $filterArray = [
            [
                'type' => 'memberof',
                'field' => 'testArray',
                'value' => 5,
            ],
        ];

        $builder = $container->get(Builder::class);
        $entityClassName = ClassUtils::getRealClass(get_class($collection->first()));
        $metadata = $objectManager->getClassMetadata($entityClassName);
        $criteria = $builder->create($metadata, $filterArray, []);

        $filteredCollection = $collection->matching($criteria);

        $this->assertEquals(3, $filteredCollection->count());
    }

    public function testNotEquals()
    {
        $container = $this->getApplication()->getServiceManager();
        $builder = $container->get(Builder::class);
        $objectManager = $container->get('doctrine.entitymanager.orm_default');
        $collection = $this->provideCollection();

        $filterArray = [
            [
                'type' => 'neq',
                'field' => 'testInteger',
                'value' => 1000,
            ],
        ];

        $builder = $container->get(Builder::class);
        $entityClassName = ClassUtils::getRealClass(get_class($collection->first()));
        $metadata = $objectManager->getClassMetadata($entityClassName);
        $criteria = $builder->create($metadata, $filterArray, []);

        $filteredCollection = $collection->matching($criteria);

        $this->assertEquals(4, $filteredCollection->count());
    }

    public function testNotIn()
    {
        $container = $this->getApplication()->getServiceManager();
        $builder = $container->get(Builder::class);
        $objectManager = $container->get('doctrine.entitymanager.orm_default');
        $collection = $this->provideCollection();

        $filterArray = [
            [
                'type' => 'notin',
                'field' => 'testInteger',
                'values' => [1000, 2000, 3000],
            ],
        ];

        $builder = $container->get(Builder::class);
        $entityClassName = ClassUtils::getRealClass(get_class($collection->first()));
        $metadata = $objectManager->getClassMetadata($entityClassName);
        $criteria = $builder->create($metadata, $filterArray, []);

        $filteredCollection = $collection->matching($criteria);

        $this->assertEquals(2, $filteredCollection->count());
    }

    public function testStartsWith()
    {
        $container = $this->getApplication()->getServiceManager();
        $builder = $container->get(Builder::class);
        $objectManager = $container->get('doctrine.entitymanager.orm_default');
        $collection = $this->provideCollection();

        $filterArray = [
            [
                'type' => 'startswith',
                'field' => 'testString',
                'value' => 'abc',
            ],
        ];

        $builder = $container->get(Builder::class);
        $entityClassName = ClassUtils::getRealClass(get_class($collection->first()));
        $metadata = $objectManager->getClassMetadata($entityClassName);
        $criteria = $builder->create($metadata, $filterArray, []);

        $filteredCollection = $collection->matching($criteria);

        $this->assertEquals(1, $filteredCollection->count());
    }
}
