<?php

namespace ApiSkeletons\Doctrine\Criteria\Filter;

use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\Mapping\ClassMetadata;

class IsNull extends AbstractFilter
{
    public function filter(Criteria $criteria, ClassMetadata $metadata, array $option)
    {
        $queryType = 'andWhere';

        if (isset($option['where'])) {
            if ($option['where'] === 'and') {
                $queryType = 'andWhere';
            } elseif ($option['where'] === 'or') {
                $queryType = 'orWhere';
            }
        }

        $criteria->$queryType($criteria->expr()->isNull($option['field']));
    }
}
