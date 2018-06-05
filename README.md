ZF Doctrine Criteria
====================

[![Build Status](https://travis-ci.org/api-skeletons/zf-doctrine-querybuilder.svg?branch=master)](https://travis-ci.org/api-skeletons/zf-doctrine-querybuilder)
[![Coverage Status](https://coveralls.io/repos/github/api-skeletons/zf-doctrine-querybuilder/badge.svg?branch=master)](https://coveralls.io/github/api-skeletons/zf-doctrine-querybuilder?branch=master)
[![Total Downloads](https://poser.pugx.org/api-skeletons/zf-doctrine-querybuilder/downloads)](https://packagist.org/packages/api-skeletons/zf-doctrine-querybuilder)

This library builds a Criteria object from array parameters for use in filtering collections.


Installation
------------

Installation of this module uses composer. For composer documentation, please refer to
[getcomposer.org](http://getcomposer.org/).

```bash
$ composer require api-skeletons/zf-doctrine-querybuilder
```

Once installed, add `ZF\Doctrine\Criteria` to your list of modules inside
`config/application.config.php`.

> ### zf-component-installer
>
> If you use [zf-component-installer](https://github.com/zendframework/zf-component-installer),
> that plugin will install zf-doctrine-criteria as a module for you.


Configuring the Module
----------------------

Copy `config/zf-doctrine-criteria.global.php.dist` to `config/autoload/zf-doctrine-criteria.global.php`
and edit the list of aliases for those you want enabled.


Use
---


Resource example
```php
$serviceLocator = $this->getApplication()->getServiceLocator();
$objectManager = $serviceLocator->get('doctrine.entitymanager.orm_default');

$filterManager = $serviceLocator->get('ZfDoctrineQueryBuilderFilterManagerOrm');
$orderByManager = $serviceLocator->get('ZfDoctrineQueryBuilderOrderByManagerOrm');

$queryBuilder = $objectManager->createQueryBuilder();
$queryBuilder->select('row')
    ->from($entity, 'row')
;

$metadata = $objectManager->getMetadataFactory()->getMetadataFor(ENTITY_NAME); // $e->getEntity() using doctrine resource event
$filterManager->filter($queryBuilder, $metadata, $_GET['filter']);
$orderByManager->orderBy($queryBuilder, $metadata, $_GET['order-by']);

$result = $queryBuilder->getQuery()->getResult();
```


Filters
-------

Filters are not simple key/value pairs. Filters are a key-less array of filter definitions.
Each filter definition is an array and the array values vary for each filter type.

Each filter definition requires at a minimum a 'type'.
A type references the configuration key such as 'eq', 'neq', 'between'.

Each filter definition requires at a minimum a 'field'. This is the name of a field on the target entity.

Each filter definition may specify 'where' with values of either 'and', 'or'.

Embedded logic such as and(x or y) is supported through AndX and OrX filter types.

### Building HTTP GET query:

Javascript Example:

```javascript
$(function () {
    $.ajax({
        url: "http://localhost:8081/api/db/entity/user_data",
        type: "GET",
        data: {
            'filter': [
                {
                    'field': 'cycle',
                    'where': 'or',
                    'type': 'between',
                    'from': '1',
                    'to': '100'
                },
                {
                    'field': 'cycle',
                    'where': 'or',
                    'type': 'gte',
                    'value': '1000'
                }
            ]
        },
        dataType: "json"
    });
});
```


Querying Relations
------------------

### Single valued
It is possible to query collections by relations - just supply the relation name as `fieldName` and
identifier as `value`.

Assuming we have defined 2 entities, `User` and `UserGroup`...

```php
/**
 * @Entity
 */
class User {
    /**
     * @ManyToOne(targetEntity="UserGroup")
     * @var UserGroup
     */
    protected $group;
}
```

```php
/**
 * @Entity
 */
class UserGroup {}
```

find all users that belong to UserGroup id #1 by querying the user resource with the following filter:

```php
['type' => 'eq', 'field' => 'group', 'value' => '1']
```

### Collection valued
To match entities A that have entity B in a collection use `ismemberof`.
Assuming `User` has a ManyToMany (or OneToMany) association with `UserGroup`...

```php
/**
 * @Entity
 */
class User {
    /**
     * @ManyToMany(targetEntity="UserGroup")
     * @var UserGroup[]|ArrayCollection
     */
    protected $groups;
}
```
find all users that belong to UserGroup id #1 by querying the user resource with the following filter:

```php
['type' => 'ismemberof', 'field' => 'groups', 'value' => '1']
```

Format of Date Fields
---------------------

When a date field is involved in a filter you may specify the format of the date using PHP date
formatting options. The default date format is `Y-m-d H:i:s` If you have a date field which is
just `Y-m-d`, then add the format to the filter. For complete date format options see
[DateTime::createFromFormat](http://php.net/manual/en/datetime.createfromformat.php)

```php
[
    'format' => 'Y-m-d',
    'value' => '2014-02-04',
]
```


Joining Entities and Aliasing Queries
-------------------------------------

There is an included ORM Query Type for Inner Join so for every filter type there is an optional `alias`.
The default alias is 'row' and refers to the entity at the heart of the REST resource.
There is not a filter to add other entities to the return data. That is, only the original target resource,
by default 'row', will be returned regardless of what filters or order by are applied through this module.

Inner Join is not included by default in the `zf-doctrine-querybuilder.global.php.dist`.

This example joins the report field through the inner join already defined on the row entity then filters
for `r.id = 2`:

```php
    ['type' => 'innerjoin', 'field' => 'report', 'alias' => 'r'],
    ['type' => 'eq', 'alias' => 'r', 'field' => 'id', 'value' => '2']
```

You can inner join tables from an inner join using `parentAlias`:

```php
    ['type' => 'innerjoin', 'parentAlias' => 'r', 'field' => 'owner', 'alias' => 'o'],
```

Inner Join is commented by default in the `zf-doctrine-querybuilder.global.php.dist`.



There is also an ORM Query Type for LeftJoin.  This join type is commonly used to fetch an empty right side of a relationship.

Left Join is commented by default in the `zf-doctrine-querybuilder.global.php.dist`.

```php
    ['type' => 'leftjoin', 'field' => 'report', 'alias' => 'r'],
    ['type' => 'isnull', 'alias' => 'r', 'field' => 'id']
```


Included Filter Types
---------------------

### ORM and ODM

Equals:

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

Is Null:

```php
['type' => 'isnull', 'field' => 'fieldName']
```

Is Not Null:

```php
['type' => 'isnotnull', 'field' => 'fieldName']
```

Note: Dates in the In and NotIn filters are not handled as dates.
It is recommended you use multiple Equals statements instead of these filters for date datatypes.

In:

```php
['type' => 'in', 'field' => 'fieldName', 'values' => [1, 2, 3]]
```

NotIn:

```php
['type' => 'notin', 'field' => 'fieldName', 'values' => [1, 2, 3]]
```

Between:

```php
['type' => 'between', 'field' => 'fieldName', 'from' => 'startValue', 'to' => 'endValue']
```

Like (`%` is used as a wildcard):

```php
['type' => 'like', 'field' => 'fieldName', 'value' => 'like%search']
```

### ORM Only

Is Member Of:

```php
['type' => 'ismemberof', 'field' => 'fieldName', 'value' => 1]
```

AndX:

In AndX queries, the `conditions` is an array of filter types for any of those described
here. The join will always be `and` so the `where` parameter inside of conditions is
ignored. The `where` parameter on the AndX filter type is not ignored.

```php
[
    'type' => 'andx',
    'conditions' => [
        ['field' =>'name', 'type'=>'eq', 'value' => 'ArtistOne'],
        ['field' =>'name', 'type'=>'eq', 'value' => 'ArtistTwo'],
    ],
    'where' => 'and',
]
```

OrX:

In OrX queries, the `conditions` is an array of filter types for any of those described
here. The join will always be `or` so the `where` parameter inside of conditions is
ignored. The `where` parameter on the OrX filter type is not ignored.

```php
[
    'type' => 'orx',
    'conditions' => [
        ['field' =>'name', 'type'=>'eq', 'value' => 'ArtistOne'],
        ['field' =>'name', 'type'=>'eq', 'value' => 'ArtistTwo'],
    ],
    'where' => 'and',
]
```

### ODM Only

Regex:

```php
['type' => 'regex', 'field' => 'fieldName', 'value' => '/.*search.*/i']
```


Included Order By Type
----------------------

Field:

```php
['type' => 'field', 'field' => 'fieldName', 'direction' => 'desc']
```
