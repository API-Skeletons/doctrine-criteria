<?php

namespace ZF\Doctrine\Criteria\Filter;

use Doctrine\Common\Collections\Criteria;

class IsNotNull extends AbstractFilter
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

        $criteria->$queryType(
            $criteria
                ->expr()
                ->isNotNull($option['alias'] . '.' . $option['field'])
        );
    }
}
