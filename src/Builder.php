<?php

namespace ZF\Doctrine\Criteria;

use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\Mapping\ClassMetadata;
use ZF\Doctrine\Criteria\Filter\Service\FilterManager;
use ZF\Doctrine\Criteria\OrderBy\Service\OrderByManager;

class Builder
{
    public function __construct(FilterManager $filterManager, OrderByManager $orderByManager)
    {
        $this->filterManager = $filterManager;
        $this->orderByManager = $orderByManager;
    }

    public function create(ClassMetadata $metadata, array $filters, array $orderBy)
    {
        $criteria = Criteria::create();

        $this->filterManager->filter($criteria, $metadata, $filters);
#        $this->orderByManager->orderBy($criteria, $metadata, $orderBy);

        return $criteria;
    }
}
