<?php

namespace ZF\Doctrine\Criteria\Filter;

use DateTime;
use Doctrine\Common\Collections\Criteria;
use ZF\Doctrine\Criteria\Filter\Service\FilterManager;

abstract class AbstractFilter implements FilterInterface
{
    abstract public function filter(Criteria $criteria, $metadata, $option);

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
            #case 'bigint':  // Don't try to manipulate bigints?
                settype($value, 'integer');
                break;
            case 'boolean':
                settype($value, 'boolean');
                break;
            case 'decimal':
            case 'float':
                settype($value, 'float');
                break;
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
                }
                break;
            default:
                break;
        }

        return $value;
    }
}
