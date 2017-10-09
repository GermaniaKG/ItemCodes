<?php
namespace Germania\Nav\ItemCodes\Exceptions;

use Psr\Container\NotFoundExceptionInterface;

class ItemCodeNotFoundException extends \RuntimeException implements ItemCodeExceptionInterface, NotFoundExceptionInterface
{
}
