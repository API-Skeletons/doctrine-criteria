<?php

namespace ZF\Doctrine\Criteria\OrderBy;

use Exception;

class Field extends AbstractOrderBy
{
    public function orderBy($queryBuilder, $metadata, $option)
    {
        if (! isset($option['alias'])) {
            $option['alias'] = 'row';
        }

        if (! isset($option['direction']) || ! in_array(strtolower($option['direction']), ['asc', 'desc'])) {
            throw new Exception('Invalid direction in orderby directive');
        }

        $queryBuilder->addOrderBy($option['alias'] . '.' . $option['field'], $option['direction']);
    }
}
