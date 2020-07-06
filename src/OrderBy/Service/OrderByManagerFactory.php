<?php

namespace ApiSkeletons\Doctrine\Criteria\OrderBy\Service;

use Laminas\Mvc\Service\AbstractPluginManagerFactory;

class OrderByManagerFactory extends AbstractPluginManagerFactory
{
    const PLUGIN_MANAGER_CLASS = OrderByManager::class;
}
