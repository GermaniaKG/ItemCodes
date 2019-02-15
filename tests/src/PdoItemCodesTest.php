<?php
namespace tests;


use Germania\Nav\ItemCodes\PdoItemCodes;
use Germania\Nav\ItemCodes\Exceptions\ItemCodeNotFoundException;

use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundException;


class PdoItemCodesTest extends \PHPUnit\Framework\TestCase
{

	use NewDatabaseTestTrait;

	
    public function testVerySimple()
    {
        $sut = new PdoItemCodes( $this->getPdo(), $GLOBALS['DB_TABLE_ITEMCODES'] );
        $this->assertGreaterThan(0, count($sut));

    }

    public function testContainerInterface()
    {
        $sut = new PdoItemCodes( $this->getPdo(), $GLOBALS['DB_TABLE_ITEMCODES'] );
        $this->assertInstanceOf(ContainerInterface::class, $sut);

        // grab one
        $items = iterator_to_array( $sut );
        $first = array_shift($items);

        $has_code = $first->getCode();

        // and assume it must be in the container
        $this->assertTrue( $sut->has( $has_code ));
        $item = $sut->get($has_code);
    }


    public function testContainerExceptions()
    {
        $sut = new PdoItemCodes( $this->getPdo(), $GLOBALS['DB_TABLE_ITEMCODES'] );
        $this->assertInstanceOf(ContainerInterface::class, $sut);

        // grab one
        $items = iterator_to_array( $sut );
        $first = array_shift($items);

        $has_not_code = 'fgjhröejhgwuhgjkwejbf';

        $this->assertFalse( $sut->has( $has_not_code ));

        $this->expectException(NotFoundException::class );
        $this->expectException(ItemCodeNotFoundException::class );

        $throooow = $sut->get( $has_not_code );
    }


}
