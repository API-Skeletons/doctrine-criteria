<?php

namespace ZF\Doctrine\Criteria;

use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\InitProviderInterface;
use Zend\ModuleManager\ModuleManagerInterface;

class Module implements
    ConfigProviderInterface,
    InitProviderInterface
{
    public function getConfig()
    {
        $provider = new ConfigProvider();

        return [
            'service_manager' => $provider->getDependencyConfig(),
        ];
    }

    public function init(ModuleManagerInterface $manager)
    {
        $serviceManager  = $manager->getEvent()->getParam('ServiceManager');
        $serviceListener = $serviceManager->get('ServiceListener');

        $serviceListener->addServiceManager(
            Filter\Service\FilterManager::class,
            'zf-doctrine-criteria-filter',
            Filter\FilterInterface::class,
            'getDoctrineCriteriaFilterConfig'
        );

        $serviceListener->addServiceManager(
            OrderBy\Service\OrderByManager::class,
            'zf-doctrine-criteria-orderby',
            OrderBy\OrderByInterface::class,
            'getDoctrineCritieraOrderByConfig'
        );
    }
}
