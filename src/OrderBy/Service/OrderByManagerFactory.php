<?php

namespace ZF\Doctrine\Criteria\OrderBy\Service;

use Zend\Mvc\Service\AbstractPluginManagerFactory;

class OrderByManagerFactory extends AbstractPluginManagerFactory
{
    const PLUGIN_MANAGER_CLASS = OrderByManager::class;
}
