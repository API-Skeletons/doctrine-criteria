<?php

namespace ZF\Doctrine\Criteria;

use Interop\Container\ContainerInterface;
use ZF\Doctrine\Criteria\Filter\Service\FilterManager;
use ZF\Doctrine\Criteria\OrderBy\Service\OrderByManager;

class BuilderFactory
{
    public function __invoke(
        ContainerInterface $container,
        $requestedName,
        array $options = null
    ) {
        $filterManager = $container->get(FilterManager::class);
        $orderByManager = $container->get(OrderByManager::class);

        return new Builder($filterManager, $orderByManager);
    }
}
