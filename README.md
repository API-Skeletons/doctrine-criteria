ZF Doctrine Criteria
====================

[![Build Status](https://travis-ci.org/API-Skeletons/doctrine-criteria.svg?branch=master)](https://travis-ci.org/API-Skeletons/doctrine-criteria)
[![Coverage](https://coveralls.io/repos/github/API-Skeletons/doctrine-criteria/badge.svg?branch=master&123)](https://coveralls.io/repos/github/API-Skeletons/doctrine-criteria/badge.svg?branch=master&123)
[![Gitter](https://badges.gitter.im/api-skeletons/open-source.svg)](https://gitter.im/api-skeletons/open-source)
[![Patreon](https://img.shields.io/badge/patreon-donate-yellow.svg)](https://www.patreon.com/apiskeletons)
[![Total Downloads](https://poser.pugx.org/api-skeletons/doctrine-criteria/downloads)](https://packagist.org/packages/api-skeletons/doctrine-criteria)

This library builds a Criteria object from array parameters for use in filtering collections.


Installation
------------

Installation of this module uses composer. For composer documentation, please refer to
[getcomposer.org](http://getcomposer.org/).

```bash
$ composer require api-skeletons/doctrine-criteria
```

Once installed, add `ZF\Doctrine\Criteria` to your list of modules inside
`config/application.config.php` or `config/modules.config.php`.

> ### laminas-component-installer
>
> If you use [laminas-component-installer](https://github.com/laminas/laminas-component-installer),
> that plugin will install doctrine-criteria as a module for you.


Configuring the Module
----------------------

Copy `config/doctrine-criteria.global.php.dist` to `config/autoload/doctrine-criteria.global.php`
and edit the list of aliases for those you want enabled.  By default all supported expressions are enabled.

> Note AND and OR composite expressions are not supported yet.


Use
---

```php
use Doctrine\Common\Util\ClassUtils;
use ZF\Doctrine\Criteria\Builder as CriteriaBuilder;

$filterArray = [
    [
        'type' => 'eq',
        'field' => 'name',
        'value' => 'Grateful Dead',
    ],
    [
        'type' => 'beginswith',
        'field' => 'state',
        'value' => 'UT',
    ],
];

$orderByArray = [
    [
        'type' => 'field',
        'field' => 'venue',
        'direction' => 'asc',
    ]
];

$criteriaBuilder = $container->get(CriteriaBuilder::class);
$entityClassName = ClassUtils::getRealClass(get_class($collection->first()));
$metadata = $objectManager->getClassMetadata($entityClassName);
$criteria = $criteriaBuilder->create($metadata, $filterArray, $orderByArray);

$filteredCollection = $collection->matching($criteria);
```


Filters
-------

Filters are not simple key/value pairs. Filters are a key-less array of filter definitions.
Each filter definition is an array and the array values vary for each filter type.

Each filter definition requires at a minimum a 'type'.
A type references the configuration key such as 'eq', 'neq', 'contains'.

Each filter definition requires at a minimum a 'field'. This is the name of a field on the target entity.

Each filter definition may specify 'where' with values of either 'and', 'or'.


Format of Date Fields
---------------------

When a date field is involved in a filter you may specify the format of the date using PHP date
formatting options. The default date format is ISO 8601 `Y-m-d\TH:i:sP` If you have a date field which is
just `Y-m-d` then add the format to the filter. For complete date format options see
[DateTime::createFromFormat](http://php.net/manual/en/datetime.createfromformat.php)

```php
[
    'format' => 'Y-m-d',
    'value' => '2014-02-04',
]
```


Included Filter Types
---------------------

Equals:

> Doctrine Collections does not currently support DateTime `Equals` comparisons.
> Any DateTime values sent through the `equals` filter will always return not equals.
> This is a shortcoming of [doctrine/collections](https://github.com/doctrine/collections)
> and not this module.  Other comparison operators should work as expected.

```php
['type' => 'eq', 'field' => 'fieldName', 'value' => 'matchValue']
```

Not Equals:

```php
['type' => 'neq', 'field' => 'fieldName', 'value' => 'matchValue']
```

Less Than:

```php
['type' => 'lt', 'field' => 'fieldName', 'value' => 'matchValue']
```

Less Than or Equals:

```php
['type' => 'lte', 'field' => 'fieldName', 'value' => 'matchValue']
```

Greater Than:

```php
['type' => 'gt', 'field' => 'fieldName', 'value' => 'matchValue']
```

Greater Than or Equals:

```php
['type' => 'gte', 'field' => 'fieldName', 'value' => 'matchValue']
```

Contains:

> Used to search inside of a string.  Comlimentary with Starts With & Ends With,
> contains matches a string inside any part of the value.

```php
['type' => 'contains', 'field' => 'fieldName', 'value' => 'matchValue']
```

Starts With:

```php
['type' => 'startswith', 'field' => 'fieldName', 'value' => 'matchValue']
```

Ends With:

```php
['type' => 'endswith', 'field' => 'fieldName', 'value' => 'matchValue']
```

Member Of:

> Used to search inside an array field to match the matchValue to an array element.

```php
['type' => 'memeberof', 'field' => 'fieldName', 'value' => 'matchValue']
```

In:

> Note: Dates in the In and NotIn filters are not handled as dates.
> It is recommended you use other filters instead of these filters for date datatypes.

```php
['type' => 'in', 'field' => 'fieldName', 'values' => [1, 2, 3]]
```

NotIn:

> Note: Dates in the In and NotIn filters are not handled as dates.
> It is recommended you use other filters instead of these filters for date datatypes.

```php
['type' => 'notin', 'field' => 'fieldName', 'values' => [1, 2, 3]]
```


OrderBy
-------

Field:

```php
['type' => 'field', 'field' => 'fieldName', 'direction' => 'desc']
```
