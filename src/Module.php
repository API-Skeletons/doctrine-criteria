<?php

namespace ApiSkeletons\Doctrine\Criteria;

use Exception;
use Laminas\ModuleManager\Feature\ConfigProviderInterface;
use Laminas\ModuleManager\Feature\InitProviderInterface;
use Laminas\ModuleManager\ModuleManagerInterface;
use Laminas\ModuleManager\ModuleManager;

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
        if (! $manager instanceof ModuleManager) {
            throw new Exception('Invalid ModuleManager');
        }

        $serviceManager  = $manager->getEvent()->getParam('ServiceManager');
        $serviceListener = $serviceManager->get('ServiceListener');

        $serviceListener->addServiceManager(
            Filter\Service\FilterManager::class,
            'apiskeletons-doctrine-criteria-filter',
            Filter\FilterInterface::class,
            'getApiSkeletonsDoctrineCriteriaFilterConfig'
        );

        $serviceListener->addServiceManager(
            OrderBy\Service\OrderByManager::class,
            'apiskeletons-doctrine-criteria-orderby',
            OrderBy\OrderByInterface::class,
            'getApiSkeletonsDoctrineCritieraOrderByConfig'
        );
    }
}
