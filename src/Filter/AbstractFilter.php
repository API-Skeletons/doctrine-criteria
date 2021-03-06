<?php

namespace ApiSkeletons\Doctrine\Criteria\Filter;

use DateTime;
use DateTimeZone;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\Common\Collections\Criteria;
use ApiSkeletons\Doctrine\Criteria\Filter\Service\FilterManager;

abstract class AbstractFilter implements FilterInterface
{
    abstract public function filter(Criteria $criteria, ClassMetadata $metadata, array $option);

    protected $filterManager;

    public function __construct($params)
    {
        $this->setFilterManager($params[0]);
    }

    public function setFilterManager(FilterManager $filterManager)
    {
        $this->filterManager = $filterManager;
        return $this;
    }

    public function getFilterManager()
    {
        return $this->filterManager;
    }

    protected function typeCastField($metadata, $field, $value, $format, $doNotTypecastDatetime = false)
    {
        if (! isset($metadata->fieldMappings[$field])) {
            return $value;
        }

        switch ($metadata->fieldMappings[$field]['type']) {
            case 'string':
                settype($value, 'string');
                break;
            case 'integer':
            case 'smallint':
            case 'bigint':
                settype($value, 'integer');
                break;
            case 'boolean':
                settype($value, 'boolean');
                break;
            case 'decimal':
            case 'float':
                settype($value, 'float');
                break;
            // @codeCoverageIgnoreStart
            case 'date':
                // For dates set time to midnight
                if ($value && ! $doNotTypecastDatetime) {
                    if (! $format) {
                        $format = 'Y-m-d';
                    }
                    $value = DateTime::createFromFormat($format, $value);
                    $value = DateTime::createFromFormat('Y-m-d H:i:s', $value->format('Y-m-d') . ' 00:00:00');
                }
                break;
            case 'time':
                if ($value && ! $doNotTypecastDatetime) {
                    if (! $format) {
                        $format = 'H:i:s';
                    }
                    $value = DateTime::createFromFormat($format, $value);
                }
                break;
            case 'datetime':
                if ($value && ! $doNotTypecastDatetime) {
                    if (! $format) {
                        $format = 'Y-m-d H:i:s';
                    }
                    $value = DateTime::createFromFormat($format, $value);

                    // Convert +00:00 timezone_type 1 to timezone_type 3 for UTC
                    $utc = new DateTimeZone('UTC');
                    if (! $utc->getOffset($value)) {
                        $value->setTimeZone($utc);
                    }
                }
                break;
            default:
                break;
            // @codeCoverageIgnoreEnd
        }

        return $value;
    }
}
