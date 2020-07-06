<?php

namespace ApiSkeletons\Doctrine\Criteria\OrderBy;

use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\Common\Collections\Criteria;

interface OrderByInterface
{
    public function orderBy(Criteria $criteria, ClassMetadata $metadata, array $option);
}
