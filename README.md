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

## Unit tests

Either copy `phpunit.xml.dist` to `phpunit.xml` and adapt to your needs, or leave as is. Run [PhpUnit](https://phpunit.de/) like this:

```bash
$ vendor/bin/phpunit
```
