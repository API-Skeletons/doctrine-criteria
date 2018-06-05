<?php

namespace ZF\Doctrine\Criteria\Filter;

use Doctrine\Common\Collections\Criteria;

class NotIn extends AbstractFilter
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

        $parameter = uniqid('a');
        $criteria->$queryType(
            $criteria
                ->expr()
                ->notIn($option['alias'] . '.' . $option['field'], ':' . $parameter)
        );
        $criteria->setParameter($parameter, $queryValues);
    }
}
