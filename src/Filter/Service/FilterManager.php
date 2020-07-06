<?php

namespace ZF\Doctrine\Criteria\Filter\Service;

use RuntimeException;
use Laminas\ServiceManager\AbstractPluginManager;
use Laminas\ServiceManager\Exception;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\Common\Collections\Criteria;
use ZF\Doctrine\Criteria\Filter\FilterInterface;

class FilterManager extends AbstractPluginManager
{
    /**
     * @var string
     */
    protected $instanceOf = FilterInterface::class;

    public function filter(Criteria $criteria, ClassMetadata $metadata, array $filters)
    {
        foreach ($filters as $option) {
            if (empty($option['type'])) {
                throw new RuntimeException('Array element "type" is required for all filters');
            }

            $filter = $this->get(strtolower($option['type']), [$this]);
            $filter->filter($criteria, $metadata, $option);
        }
    }

    /**
     * Validate the plugin is of the expected type (v3).
     *
     * Validates against `$instanceOf`.
     *
     * @param mixed $instance
     * @return void
     * @throws Exception\InvalidServiceException
     * @codeCoverageIgnore
     */
    public function validate($instance)
    {
        if (! $instance instanceof $this->instanceOf) {
            throw new Exception\InvalidServiceException(sprintf(
                '%s can only create instances of %s; %s is invalid',
                get_class($this),
                $this->instanceOf,
                is_object($instance) ? get_class($instance) : gettype($instance)
            ));
        }
    }

    /**
     * Validate the plugin is of the expected type (v2).
     *
     * Proxies to `validate()`.
     *
     * @param mixed $instance
     * @return void
     * @throws Exception\InvalidArgumentException
     * @codeCoverageIgnore
     */
    public function validatePlugin($instance)
    {
        try {
            $this->validate($instance);
        } catch (Exception\InvalidServiceException $e) {
            throw new Exception\InvalidArgumentException($e->getMessage(), $e->getCode(), $e);
        }
    }
}
