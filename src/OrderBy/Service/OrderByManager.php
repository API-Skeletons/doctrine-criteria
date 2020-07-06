<?php

namespace ZF\Doctrine\Criteria\OrderBy\Service;

use RuntimeException;
use Laminas\ServiceManager\AbstractPluginManager;
use Laminas\ServiceManager\Exception;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\Mapping\ClassMetadata;
use ZF\Doctrine\Criteria\OrderBy\OrderByInterface;

class OrderByManager extends AbstractPluginManager
{
    /**
     * @var string
     */
    protected $instanceOf = OrderByInterface::class;

    public function orderBy(Criteria $criteria, ClassMetadata $metadata, array $orderBy)
    {
        $orderings = [];
        foreach ($orderBy as $option) {
            if (empty($option['type'])) {
                throw new RuntimeException('Array element "type" is required for all orderby directives');
            }

            $orderByHandler = $this->get(strtolower($option['type']), [$this]);
            $ordering = $orderByHandler->orderBy($criteria, $metadata, $option);
            foreach ($ordering as $field => $direction) {
                $orderings[$field] = $direction;
            }
        }

        $criteria->orderBy($orderings);
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
