<?php

namespace ApiSkeletons\Doctrine\Criteria\Filter;

use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\Common\Collections\Criteria;

class LessThan extends AbstractFilter
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

        $format = $option['format'] ?? 'Y-m-d\TH:i:sP';
        $value = $this->typeCastField($metadata, $option['field'], $option['value'], $format);

        $criteria->$queryType($criteria->expr()->lt($option['field'], $value));
    }
}
