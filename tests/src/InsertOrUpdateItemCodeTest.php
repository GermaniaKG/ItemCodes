<?php
namespace tests;

use Germania\Nav\ItemCodes\Actions\InsertOrUpdateItemCode;
use Germania\Nav\ItemCodes\ItemCodeInterface;

use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundException;


class InsertOrUpdateItemCodeTest extends \PHPUnit\Framework\TestCase
{

	use NewDatabaseTestTrait;

    public function testInsertion()
    {
    	$this->resetDatabase();
        $logger = null;
        $sut = new InsertOrUpdateItemCode( $this->getPdo(), $GLOBALS['DB_TABLE_ITEMCODES'], $logger );

        $itemcode_mock_1 = $this->prophesize( ItemCodeInterface::class );
        $itemcode_mock_1->getCode()->willReturn("XYZ");
        $itemcode_mock_1->getName()->willReturn("An XYZ Item");
        $item_code1 = $itemcode_mock_1->reveal();

        $row_count = $sut->execute( $item_code1 );
        $this->assertEquals(1, $row_count);
    }


    public function testInvokationInsertion()
    {
    	$this->resetDatabase();
        $logger = null;
        $sut = new InsertOrUpdateItemCode( $this->getPdo(), $GLOBALS['DB_TABLE_ITEMCODES'], $logger );

        $itemcode_mock_1 = $this->prophesize( ItemCodeInterface::class );
        $itemcode_mock_1->getCode()->willReturn("XYZ");
        $itemcode_mock_1->getName()->willReturn("An XYZ Item");
        $item_code1 = $itemcode_mock_1->reveal();

        $row_count = $sut( $item_code1 );
        $this->assertEquals(1, $row_count);
    }


    public function testUpdate()
    {
    	$this->resetDatabase();    	
        $logger = null;
        $sut = new InsertOrUpdateItemCode( $this->getPdo(), $GLOBALS['DB_TABLE_ITEMCODES'], $logger );


        $itemcode_mock_1 = $this->prophesize( ItemCodeInterface::class );
        $itemcode_mock_1->getCode()->willReturn("XYZ");
        $itemcode_mock_1->getName()->willReturn("An XYZ Item");
        $item_code1 = $itemcode_mock_1->reveal();

        $row_count = $sut->execute( $item_code1 );
        $this->assertEquals(1, $row_count);

        // The FOO key must exist
        $itemcode_mock_2 = $this->prophesize( ItemCodeInterface::class );
        $itemcode_mock_2->getCode()->willReturn("FOO");
        $itemcode_mock_2->getName()->willReturn("A rewritten FOO Item");
        $item_code2 = $itemcode_mock_2->reveal();

        $row_count = $sut->execute( $item_code2 );
        $this->assertEquals(2, $row_count);

    }


}
