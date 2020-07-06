<?php

namespace ApiSkeletons\Doctrine\Criteria\OrderBy;

use RuntimeException;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\Common\Collections\Criteria;

class Field extends AbstractOrderBy
{
    public function orderBy(Criteria $criteria, ClassMetadata $metadata, array $option)
    {
        if (! isset($option['direction']) || ! in_array(strtolower($option['direction']), ['asc', 'desc'])) {
            throw new RuntimeException('Invalid direction in orderby directive');
        }

        return [$option['field'] => $option['direction']];
    }
}
