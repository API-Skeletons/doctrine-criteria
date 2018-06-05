<?php

namespace ZF\Doctrine\Criteria\Filter;

use Doctrine\Common\Collections\Criteria;

interface FilterInterface
{
    public function filter(Criteria $criteria, $metadata, $option);
}
