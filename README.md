# Germania KG · ItemCodes



## Installation

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

## Development

```bash
$ git clone https://github.com/GermaniaKG/ItemCodes.git
$ cd ItemCodes
$ composer install
```

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

## Unit tests

Either copy `phpunit.xml.dist` to `phpunit.xml` and adapt to your needs, or leave as is. Run [PhpUnit](https://phpunit.de/) like this:

```bash
$ vendor/bin/phpunit
```
