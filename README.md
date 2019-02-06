# Germania KG · ItemCodes

[![Packagist](https://img.shields.io/packagist/v/germania-kg/itemcodes.svg?style=flat)](https://packagist.org/packages/germania-kg/itemcodes)
[![PHP version](https://img.shields.io/packagist/php-v/germania-kg/itemcodes.svg)](https://packagist.org/packages/germania-kg/itemcodes)
[![Build Status](https://img.shields.io/travis/GermaniaKG/ItemCodes.svg?label=Travis%20CI)](https://travis-ci.org/GermaniaKG/ItemCodes)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/GermaniaKG/ItemCodes/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/GermaniaKG/ItemCodes/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/GermaniaKG/ItemCodes/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/GermaniaKG/ItemCodes/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/GermaniaKG/ItemCodes/badges/build.png?b=master)](https://scrutinizer-ci.com/g/GermaniaKG/ItemCodes/build-status/master)


## Installation with Composer

```bash
$ composer require germania-kg/itemcodes
```

Alternatively, add this package directly to your composer.json:

```json
"require": {
    "germania-kg/itemcodes": "^1.0"
}
```

Make sure the **itemcodes** table exists; see [Database](#database) section.


## Database

Setup the MySQL table **itemcodes** as described in `sql/itemcodes.sql.txt`.
Rename the table if needed. 

## Usage

#### ItemCode

```php
<?php
use Germania\Nav\ItemCodes\ItemCode;

$itemcode = new ItemCode;
$itemcode->setCode("COD")->setName("The Code Name");
```


#### InsertOrUpdateItemCode

This action class requires at least a PDO handle an a table name to work with. A PSR-3 Logger is optional.

```php
<?php
use Germania\Nav\ItemCodes\Actions\InsertOrUpdateItemCode;

// Setup ingredients
$pdo = new \PDO( ... );
$table = "my_itemcodes";

// Optional PSR-3 Logger
$logger = ...

$inserter = new InsertOrUpdateItemCode( $pdo, $table);
$inserter = new InsertOrUpdateItemCode( $pdo, $table, $logger);

// Both are equal:
$result = $insert_or_update( $itemcode );
$result = $insert_or_update->execute( $itemcode );

// $result is 1 when ItemCode has been INSERTed,
// and 2, when REPLACEd
```

## Issues


- As of release 2.0.0, Travis CI and Scrutinizer should be part of the game, but not working as expected. See issues for [Travis CI][i1] and [Scrutinizer][i2].
- See [issues list.][i0]


[i0]: https://github.com/GermaniaKG/ItemCodes/issues 
[i1]: https://github.com/GermaniaKG/ItemCodes/issues/1
[i2]: https://github.com/GermaniaKG/ItemCodes/issues/2 

## Development

```bash
$ git clone https://github.com/GermaniaKG/ItemCodes.git
$ cd ItemCodes
$ composer install
```

## Unit tests

Either copy `phpunit.xml.dist` to `phpunit.xml` and adapt to your needs, or leave as is. Run [PhpUnit](https://phpunit.de/) test or composer scripts like this:

```bash
$ composer test
# or
$ vendor/bin/phpunit
```

