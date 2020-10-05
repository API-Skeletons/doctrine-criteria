<?php

namespace ApiSkeletonsTest\Doctrine\Criteria;

use Doctrine\Common\Criteria\ArrayCollection;
use Doctrine\Common\Util\ClassUtils;
use Doctrine\ORM\Mapping\ClassMetadata;
use ApiSkeletons\Doctrine\Criteria\Builder;
use DbTest\Entity\Test;
use ApiSkeletons\Doctrine\Criteria\Filter\Service\FilterManager;
use DateTime;

class FilterTest extends AbstractTest
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

    public function testContainsOr()
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
                'where' => 'or',
            ],
            [
                'type' => 'contains',
                'field' => 'testString',
                'value' => 'fg',
                'where' => 'or',
            ],
        ];

        $builder = $container->get(Builder::class);
        $entityClassName = ClassUtils::getRealClass(get_class($collection->first()));
        $metadata = $objectManager->getClassMetadata($entityClassName);
        $criteria = $builder->create($metadata, $filterArray, []);

        $filteredCollection = $collection->matching($criteria);

        $this->assertEquals(2, $filteredCollection->count());
    }

    public function testEndsWithOr()
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
                'where' => 'or',
            ],
            [
                'type' => 'endswith',
                'field' => 'testString',
                'value' => 'ij',
                'where' => 'or',
            ],
        ];

        $builder = $container->get(Builder::class);
        $entityClassName = ClassUtils::getRealClass(get_class($collection->first()));
        $metadata = $objectManager->getClassMetadata($entityClassName);
        $criteria = $builder->create($metadata, $filterArray, []);

        $filteredCollection = $collection->matching($criteria);

        $this->assertEquals(2, $filteredCollection->count());
    }

    public function testEqualsOr()
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
                'where' => 'or',
            ],
            [
                'type' => 'eq',
                'field' => 'testInteger',
                'value' => 2000,
                'where' => 'or',
            ],
        ];

        $builder = $container->get(Builder::class);
        $entityClassName = ClassUtils::getRealClass(get_class($collection->first()));
        $metadata = $objectManager->getClassMetadata($entityClassName);
        $criteria = $builder->create($metadata, $filterArray, []);

        $filteredCollection = $collection->matching($criteria);

        $this->assertEquals(2, $filteredCollection->count());
    }

    public function testGreaterThanOr()
    {
        $container = $this->getApplication()->getServiceManager();
        $builder = $container->get(Builder::class);
        $objectManager = $container->get('doctrine.entitymanager.orm_default');
        $collection = $this->provideCollection();

        $filterArray = [
            [
                'type' => 'gt',
                'field' => 'testInteger',
                'value' => 4000,
                'where' => 'or',
            ],
            [
                'type' => 'lt',
                'field' => 'testInteger',
                'value' => 2000,
                'where' => 'or',
            ],
        ];

        $builder = $container->get(Builder::class);
        $entityClassName = ClassUtils::getRealClass(get_class($collection->first()));
        $metadata = $objectManager->getClassMetadata($entityClassName);
        $criteria = $builder->create($metadata, $filterArray, []);

        $filteredCollection = $collection->matching($criteria);

        $this->assertEquals(2, $filteredCollection->count());
    }

    public function testGreaterThanOrEqualsOr()
    {
        $container = $this->getApplication()->getServiceManager();
        $builder = $container->get(Builder::class);
        $objectManager = $container->get('doctrine.entitymanager.orm_default');
        $collection = $this->provideCollection();

        $filterArray = [
            [
                'type' => 'gte',
                'field' => 'testInteger',
                'value' => 4000,
                'where' => 'or',
            ],
            [
                'type' => 'lte',
                'field' => 'testInteger',
                'value' => 1000,
                'where' => 'or',
            ],
        ];

        $builder = $container->get(Builder::class);
        $entityClassName = ClassUtils::getRealClass(get_class($collection->first()));
        $metadata = $objectManager->getClassMetadata($entityClassName);
        $criteria = $builder->create($metadata, $filterArray, []);

        $filteredCollection = $collection->matching($criteria);

        $this->assertEquals(3, $filteredCollection->count());
    }

    public function testInOr()
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
                'where' => 'or',
            ],
            [
                'type' => 'in',
                'field' => 'testInteger',
                'values' => [4000],
                'where' => 'or',
            ],
        ];

        $builder = $container->get(Builder::class);
        $entityClassName = ClassUtils::getRealClass(get_class($collection->first()));
        $metadata = $objectManager->getClassMetadata($entityClassName);
        $criteria = $builder->create($metadata, $filterArray, []);

        $filteredCollection = $collection->matching($criteria);

        $this->assertEquals(4, $filteredCollection->count());
    }

    public function testLessThanOr()
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
                'where' => 'or',
            ],
            [
                'type' => 'gt',
                'field' => 'testInteger',
                'value' => 3000,
                'where' => 'or',
            ],
        ];

        $builder = $container->get(Builder::class);
        $entityClassName = ClassUtils::getRealClass(get_class($collection->first()));
        $metadata = $objectManager->getClassMetadata($entityClassName);
        $criteria = $builder->create($metadata, $filterArray, []);

        $filteredCollection = $collection->matching($criteria);

        $this->assertEquals(4, $filteredCollection->count());
    }

    public function testLessThanOrEqualsOr()
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
                'where' => 'or',
            ],
            [
                'type' => 'gte',
                'field' => 'testInteger',
                'value' => 5000,
                'where' => 'or',
            ],
        ];

        $builder = $container->get(Builder::class);
        $entityClassName = ClassUtils::getRealClass(get_class($collection->first()));
        $metadata = $objectManager->getClassMetadata($entityClassName);
        $criteria = $builder->create($metadata, $filterArray, []);

        $filteredCollection = $collection->matching($criteria);

        $this->assertEquals(4, $filteredCollection->count());
    }

    public function testMemberOfOr()
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
                'where' => 'or',
            ],
            [
                'type' => 'memberof',
                'field' => 'testArray',
                'value' => 9,
                'where' => 'or',
            ],
        ];

        $builder = $container->get(Builder::class);
        $entityClassName = ClassUtils::getRealClass(get_class($collection->first()));
        $metadata = $objectManager->getClassMetadata($entityClassName);
        $criteria = $builder->create($metadata, $filterArray, []);

        $filteredCollection = $collection->matching($criteria);

        $this->assertEquals(4, $filteredCollection->count());
    }

    public function testNotEqualsOr()
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
                'where' => 'or',
            ],
            [
                'type' => 'neq',
                'field' => 'testInteger',
                'value' => 2000,
                'where' => 'or',
            ],
        ];

        $builder = $container->get(Builder::class);
        $entityClassName = ClassUtils::getRealClass(get_class($collection->first()));
        $metadata = $objectManager->getClassMetadata($entityClassName);
        $criteria = $builder->create($metadata, $filterArray, []);

        $filteredCollection = $collection->matching($criteria);

        $this->assertEquals(5, $filteredCollection->count());
    }

    public function testNotInOr()
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
                'where' => 'or',
            ],
            [
                'type' => 'notin',
                'field' => 'testInteger',
                'values' => [1000, 2000, 3000, 4000],
                'where' => 'or',
            ],
        ];

        $builder = $container->get(Builder::class);
        $entityClassName = ClassUtils::getRealClass(get_class($collection->first()));
        $metadata = $objectManager->getClassMetadata($entityClassName);
        $criteria = $builder->create($metadata, $filterArray, []);

        $filteredCollection = $collection->matching($criteria);

        $this->assertEquals(2, $filteredCollection->count());
    }

    public function testStartsWithOr()
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
                'where' => 'or',
            ],
            [
                'type' => 'startswith',
                'field' => 'testString',
                'value' => 'fgh',
                'where' => 'or',
            ],
        ];

        $builder = $container->get(Builder::class);
        $entityClassName = ClassUtils::getRealClass(get_class($collection->first()));
        $metadata = $objectManager->getClassMetadata($entityClassName);
        $criteria = $builder->create($metadata, $filterArray, []);

        $filteredCollection = $collection->matching($criteria);

        $this->assertEquals(2, $filteredCollection->count());
    }










    public function testContainsAnd()
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
                'where' => 'and',
            ],
            [
                'type' => 'contains',
                'field' => 'testString',
                'value' => 'ab',
                'where' => 'and',
            ],
        ];

        $builder = $container->get(Builder::class);
        $entityClassName = ClassUtils::getRealClass(get_class($collection->first()));
        $metadata = $objectManager->getClassMetadata($entityClassName);
        $criteria = $builder->create($metadata, $filterArray, []);

        $filteredCollection = $collection->matching($criteria);

        $this->assertEquals(1, $filteredCollection->count());
    }

    public function testEndsWithAnd()
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
                'where' => 'and',
            ],
            [
                'type' => 'endswith',
                'field' => 'testString',
                'value' => 'e',
                'where' => 'and',
            ],
        ];

        $builder = $container->get(Builder::class);
        $entityClassName = ClassUtils::getRealClass(get_class($collection->first()));
        $metadata = $objectManager->getClassMetadata($entityClassName);
        $criteria = $builder->create($metadata, $filterArray, []);

        $filteredCollection = $collection->matching($criteria);

        $this->assertEquals(1, $filteredCollection->count());
    }

    public function testEqualsAnd()
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
                'where' => 'and',
            ],
            [
                'type' => 'eq',
                'field' => 'testString',
                'value' => 'abcde',
                'where' => 'and',
            ],
        ];

        $builder = $container->get(Builder::class);
        $entityClassName = ClassUtils::getRealClass(get_class($collection->first()));
        $metadata = $objectManager->getClassMetadata($entityClassName);
        $criteria = $builder->create($metadata, $filterArray, []);

        $filteredCollection = $collection->matching($criteria);

        $this->assertEquals(1, $filteredCollection->count());
    }

    public function testGreaterThanAnd()
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
                'where' => 'and',
            ],
            [
                'type' => 'gt',
                'field' => 'testBigint',
                'value' => 12345,
                'where' => 'and',
            ],
        ];

        $builder = $container->get(Builder::class);
        $entityClassName = ClassUtils::getRealClass(get_class($collection->first()));
        $metadata = $objectManager->getClassMetadata($entityClassName);
        $criteria = $builder->create($metadata, $filterArray, []);

        $filteredCollection = $collection->matching($criteria);

        $this->assertEquals(4, $filteredCollection->count());
    }

    public function testGreaterThanOrEqualsAnd()
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
                'where' => 'and',
            ],
            [
                'type' => 'gte',
                'field' => 'testBigint',
                'value' => 123456,
                'where' => 'and',
            ],
        ];

        $builder = $container->get(Builder::class);
        $entityClassName = ClassUtils::getRealClass(get_class($collection->first()));
        $metadata = $objectManager->getClassMetadata($entityClassName);
        $criteria = $builder->create($metadata, $filterArray, []);

        $filteredCollection = $collection->matching($criteria);

        $this->assertEquals(4, $filteredCollection->count());
    }

    public function testInAnd()
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
                'where' => 'and',
            ],
            [
                'type' => 'in',
                'field' => 'testInteger',
                'values' => [1000, 3000],
                'where' => 'and',
            ],
        ];

        $builder = $container->get(Builder::class);
        $entityClassName = ClassUtils::getRealClass(get_class($collection->first()));
        $metadata = $objectManager->getClassMetadata($entityClassName);
        $criteria = $builder->create($metadata, $filterArray, []);

        $filteredCollection = $collection->matching($criteria);

        $this->assertEquals(2, $filteredCollection->count());
    }

    public function testLessThanAnd()
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
                'where' => 'and',
            ],
            [
                'type' => 'lt',
                'field' => 'testInteger',
                'value' => 2000,
                'where' => 'and',
            ],
        ];

        $builder = $container->get(Builder::class);
        $entityClassName = ClassUtils::getRealClass(get_class($collection->first()));
        $metadata = $objectManager->getClassMetadata($entityClassName);
        $criteria = $builder->create($metadata, $filterArray, []);

        $filteredCollection = $collection->matching($criteria);

        $this->assertEquals(1, $filteredCollection->count());
    }

    public function testLessThanOrEqualsAnd()
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
                'where' => 'and',
            ],
            [
                'type' => 'lte',
                'field' => 'testInteger',
                'value' => 2000,
                'where' => 'and',
            ],
        ];

        $builder = $container->get(Builder::class);
        $entityClassName = ClassUtils::getRealClass(get_class($collection->first()));
        $metadata = $objectManager->getClassMetadata($entityClassName);
        $criteria = $builder->create($metadata, $filterArray, []);

        $filteredCollection = $collection->matching($criteria);

        $this->assertEquals(2, $filteredCollection->count());
    }

    public function testMemberOfAnd()
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
                'where' => 'and',
            ],
            [
                'type' => 'memberof',
                'field' => 'testArray',
                'value' => 15,
                'where' => 'and',
            ],
        ];

        $builder = $container->get(Builder::class);
        $entityClassName = ClassUtils::getRealClass(get_class($collection->first()));
        $metadata = $objectManager->getClassMetadata($entityClassName);
        $criteria = $builder->create($metadata, $filterArray, []);

        $filteredCollection = $collection->matching($criteria);

        $this->assertEquals(1, $filteredCollection->count());
    }

    public function testNotEqualsAnd()
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
                'where' => 'and',
            ],
            [
                'type' => 'neq',
                'field' => 'testInteger',
                'value' => 2000,
                'where' => 'and',
            ],
        ];

        $builder = $container->get(Builder::class);
        $entityClassName = ClassUtils::getRealClass(get_class($collection->first()));
        $metadata = $objectManager->getClassMetadata($entityClassName);
        $criteria = $builder->create($metadata, $filterArray, []);

        $filteredCollection = $collection->matching($criteria);

        $this->assertEquals(3, $filteredCollection->count());
    }

    public function testNotInAnd()
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
                'where' => 'and',
            ],
            [
                'type' => 'notin',
                'field' => 'testInteger',
                'values' => [4000],
                'where' => 'and',
            ],
        ];

        $builder = $container->get(Builder::class);
        $entityClassName = ClassUtils::getRealClass(get_class($collection->first()));
        $metadata = $objectManager->getClassMetadata($entityClassName);
        $criteria = $builder->create($metadata, $filterArray, []);

        $filteredCollection = $collection->matching($criteria);

        $this->assertEquals(1, $filteredCollection->count());
    }

    public function testStartsWithAnd()
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
                'where' => 'and',
            ],
            [
                'type' => 'startswith',
                'field' => 'testString',
                'value' => 'ab',
                'where' => 'and',
            ],
        ];

        $builder = $container->get(Builder::class);
        $entityClassName = ClassUtils::getRealClass(get_class($collection->first()));
        $metadata = $objectManager->getClassMetadata($entityClassName);
        $criteria = $builder->create($metadata, $filterArray, []);

        $filteredCollection = $collection->matching($criteria);

        $this->assertEquals(1, $filteredCollection->count());
    }

    public function testEqualsBoolean()
    {
        $container = $this->getApplication()->getServiceManager();
        $builder = $container->get(Builder::class);
        $objectManager = $container->get('doctrine.entitymanager.orm_default');
        $collection = $this->provideCollection();

        $filterArray = [
            [
                'type' => 'eq',
                'field' => 'testBoolean',
                'value' => true,
            ],
        ];

        $builder = $container->get(Builder::class);
        $entityClassName = ClassUtils::getRealClass(get_class($collection->first()));
        $metadata = $objectManager->getClassMetadata($entityClassName);
        $criteria = $builder->create($metadata, $filterArray, []);

        $filteredCollection = $collection->matching($criteria);

        $this->assertEquals(3, $filteredCollection->count());
    }

    public function testEqualsFloat()
    {
        $container = $this->getApplication()->getServiceManager();
        $builder = $container->get(Builder::class);
        $objectManager = $container->get('doctrine.entitymanager.orm_default');
        $collection = $this->provideCollection();

        $filterArray = [
            [
                'type' => 'eq',
                'field' => 'testFloat',
                'value' => 54.321,
            ],
        ];

        $builder = $container->get(Builder::class);
        $entityClassName = ClassUtils::getRealClass(get_class($collection->first()));
        $metadata = $objectManager->getClassMetadata($entityClassName);
        $criteria = $builder->create($metadata, $filterArray, []);

        $filteredCollection = $collection->matching($criteria);

        $this->assertEquals(5, $filteredCollection->count());
    }

    public function testIsNull()
    {
        $container = $this->getApplication()->getServiceManager();
        $builder = $container->get(Builder::class);
        $objectManager = $container->get('doctrine.entitymanager.orm_default');
        $collection = $this->provideNullCollection();

        $filterArray = [
            [
                'type' => 'isnull',
                'field' => 'testString',
            ],
        ];

        $builder = $container->get(Builder::class);
        $entityClassName = ClassUtils::getRealClass(get_class($collection->first()));
        $metadata = $objectManager->getClassMetadata($entityClassName);
        $criteria = $builder->create($metadata, $filterArray, []);

        $filteredCollection = $collection->matching($criteria);

        $this->assertEquals(1, $filteredCollection->count());
    }

/**
 * Date fields are not handled by Criteria!!!
 *
    public function testEqualsDate()
    {
        $container = $this->getApplication()->getServiceManager();
        $builder = $container->get(Builder::class);
        $objectManager = $container->get('doctrine.entitymanager.orm_default');
        $collection = $this->provideCollection();

        $filterArray = [
            [
                'type' => 'eq',
                'field' => 'testDateTime',
                'value' => '2018-06-08',
                'format' => 'Y-m-d',
            ],
        ];

        $builder = $container->get(Builder::class);
        $entityClassName = ClassUtils::getRealClass(get_class($collection->first()));
        $metadata = $objectManager->getClassMetadata($entityClassName);
        $criteria = $builder->create($metadata, $filterArray, []);

        $filteredCollection = $collection->matching($criteria);

        $this->assertEquals(1, $filteredCollection->count());
    }
*/
}
