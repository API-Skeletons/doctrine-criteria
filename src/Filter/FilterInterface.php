<?php

namespace ApiSkeletons\Doctrine\Criteria\Filter;

use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\Common\Collections\Criteria;

interface FilterInterface
{
    public function filter(Criteria $criteria, ClassMetadata $metadata, array $option);
}
