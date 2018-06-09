<?php

namespace ZF\Doctrine\Criteria;

class ConfigProvider
{
    /**
     * Return general purpose configuration
     *
     * @return array
     */
    public function __invoke()
    {
        return [
            'dependencies' => $this->getDependencyConfig(),
        ];
    }

    /**
     * Return application-level dependency configuration.
     *
     * @return array
     */
    public function getDependencyConfig()
    {
        return [
            'factories' => [
                Filter\Service\FilterManager::class => Filter\Service\FilterManagerFactory::class,
                OrderBy\Service\OrderByManager::class => OrderBy\Service\OrderByManagerFactory::class,
                Builder::class => BuilderFactory::class,
            ],
        ];
    }
}
