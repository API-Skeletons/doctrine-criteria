<?php

namespace ApiSkeletons\Doctrine\Criteria;

use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\Mapping\ClassMetadata;
use ApiSkeletons\Doctrine\Criteria\Filter\Service\FilterManager;
use ApiSkeletons\Doctrine\Criteria\OrderBy\Service\OrderByManager;

class Builder
{
    private $filterManager;
    private $orderByManager;

    public function __construct(FilterManager $filterManager, OrderByManager $orderByManager)
    {
        $this->filterManager = $filterManager;
        $this->orderByManager = $orderByManager;
    }

    public function create(ClassMetadata $metadata, array $filters, array $orderBy)
    {
        $criteria = Criteria::create();

        $this->filterManager->filter($criteria, $metadata, $filters);
        $this->orderByManager->orderBy($criteria, $metadata, $orderBy);

        return $criteria;
    }
}
