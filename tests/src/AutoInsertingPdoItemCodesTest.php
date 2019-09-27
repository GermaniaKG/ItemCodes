<?php
namespace tests;


use Germania\Nav\ItemCodes\PdoItemCodes;
use Germania\Nav\ItemCodes\ItemCodeInterface;
use Germania\Nav\ItemCodes\AutoInsertingPdoItemCodes;
use Germania\Nav\ItemCodes\Exceptions\ItemCodeNotFoundException;

use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundException;


class AutoInsertingPdoItemCodesTest extends \PHPUnit\Framework\TestCase
{

	use NewDatabaseTestTrait;

	
    public function testVerySimple()
    {
        $sut = new AutoInsertingPdoItemCodes( $this->getPdo(), $GLOBALS['DB_TABLE_ITEMCODES'] );
        $this->assertGreaterThan(0, count($sut));

        return $sut;

    }


    /**
     * @depends testVerySimple
     */
    public function testContainerInterface( $sut )
    {
        $this->assertInstanceOf(ContainerInterface::class, $sut);

        // grab one
        $items = iterator_to_array( $sut );
        $first = array_shift($items);

        $has_code = $first->getCode();

        // and assume it must be in the container
        $this->assertTrue( $sut->has( $has_code ));
        $item = $sut->get($has_code);

        return $sut;
    }


    /**
     * @depends testContainerInterface
     */
    public function testAutoInsertion( $sut )
    {
        $this->assertInstanceOf(ContainerInterface::class, $sut);

        // grab one
        $items = iterator_to_array( $sut );
        $first = array_shift($items);

        $has_not_code = 'ABC';

        $this->assertFalse( $sut->has( $has_not_code ));
        // Let SUT auto-insert
        $sut->get( $has_not_code );
        
        $this->assertTrue( $sut->has( $has_not_code ));
    }


    /**
     * @depends testContainerInterface
     */
    public function testAutoInsertionOnPush( $sut )
    {
        $new_code = "CDE";

        $itemcode = $this->prophesize(ItemCodeInterface::class);
        $itemcode->getCode()->willReturn($new_code);
        $itemcode->getName()->willReturn($new_code);
        $itemcode_stub = $itemcode->reveal();


        $this->assertFalse( $sut->has( $new_code ));
        // Let SUT auto-insert
        $sut->push( $itemcode_stub );
        
        $this->assertTrue( $sut->has( $new_code ));
    }


}
