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
        }

        if (! isset($queryType)) {
            $queryType = 'andWhere';
        }

        if (! isset($option['alias'])) {
            $option['alias'] = 'row';
        }

        $format = isset($option['format']) ? $option['format'] : null;

        $value = $this->typeCastField($metadata, $option['field'], $option['value'], $format);

        $parameter = uniqid('a');
        $criteria->$queryType(
            $criteria
                ->expr()
                ->neq($option['alias'] . '.' . $option['field'], ':' . $parameter)
        );
        $criteria->setParameter($parameter, $value);
    }
}
