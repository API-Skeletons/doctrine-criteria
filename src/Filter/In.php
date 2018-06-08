<?php

namespace ZF\Doctrine\Criteria\Filter;

use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\Common\Collections\Criteria;

class In extends AbstractFilter
{
    public function filter(Criteria $criteria, ClassMetadata $metadata, array $option)
    {
        if (isset($option['where'])) {
            if ($option['where'] === 'and') {
                $queryType = 'andWhere';
            } elseif ($option['where'] === 'or') {
                $queryType = 'orWhere';
            }
        } else {
            $queryType = 'andWhere';
        }


        $format = $option['format'] ?? 'Y-m-d\TH:i:sP';

        $queryValues = [];
        foreach ($option['values'] as $value) {
            $queryValues[] = $this->typeCastField(
                $metadata,
                $option['field'],
                $value,
                $format,
                $doNotTypecastDatetime = true
            );
        }

        $criteria->$queryType($criteria->expr()->in($option['field'], $queryValues));
    }
}
