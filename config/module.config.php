<?php

namespace ZF\Doctrine\Criteria;

return [
    'service_manager' => [
        'factories' => [
            Filter\Service\FilterManager::class => Filter\Service\FilterManagerFactory::class,
            OrderBy\Service\OrderByManager::class => OrderBy\Service\OrderByManagerFactory::class,
        ],
    ],
];
