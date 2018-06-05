<?php

namespace ZF\Doctrine\Criteria\OrderBy;

use ZF\Doctrine\Criteria\OrderBy\OrderByInterface;
use ZF\Doctrine\Criteria\OrderBy\Service\OrderByManager;

abstract class AbstractOrderBy implements OrderByInterface
{
    abstract public function orderBy($queryBuilder, $metadata, $option);

    protected $orderByManager;

    public function __construct($params)
    {
        $this->setOrderByManager($params[0]);
    }

    public function setOrderByManager(OrderByManager $orderByManager)
    {
        $this->orderByManager = $orderByManager;

        return $this;
    }

    public function getOrderByManager()
    {
        return $this->orderByManager;
    }
}
