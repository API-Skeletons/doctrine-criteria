<?php

namespace ZF\Doctrine\Criteria\Filter\Service;

use Laminas\Mvc\Service\AbstractPluginManagerFactory;

class FilterManagerFactory extends AbstractPluginManagerFactory
{
    const PLUGIN_MANAGER_CLASS = FilterManager::class;
}
