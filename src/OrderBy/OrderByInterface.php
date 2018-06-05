<?php

namespace ZF\Doctrine\Criteria\OrderBy;

interface OrderByInterface
{
    public function orderBy($queryBuilder, $metadata, $option);
}
