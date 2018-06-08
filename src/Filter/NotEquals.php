<?php

namespace ZF\Doctrine\Criteria\Filter;

use Doctrine\Common\Collections\Criteria;

class NotEquals extends AbstractFilter
{
    public function filter(Criteria $criteria, $metadata, $option)
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
        $value = $this->typeCastField($metadata, $option['field'], $option['value'], $format);

        $criteria->$queryType($criteria->expr()->neq($option['field'], $value));
    }
}
