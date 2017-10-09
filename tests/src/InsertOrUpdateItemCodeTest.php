<?php
namespace tests;

use tests\DatabaseTestCaseAbstract;

use Germania\Nav\ItemCodes\Actions\InsertOrUpdateItemCode;
use Germania\Nav\ItemCodes\ItemCodeInterface;

use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundException;


class InsertOrUpdateItemCodeTest extends DatabaseTestCaseAbstract
{

    public function testInstantiation()
    {
        $logger = null;
        $sut = new InsertOrUpdateItemCode( $this->getPdo(), $logger, $GLOBALS['DB_TABLE_ITEMCODES'] );
    }

    public function testInsertion()
    {
        $logger = null;
        $sut = new InsertOrUpdateItemCode( $this->getPdo(), $logger, $GLOBALS['DB_TABLE_ITEMCODES'] );

        $itemcode_mock_1 = $this->prophesize( ItemCodeInterface::class );
        $itemcode_mock_1->getCode()->willReturn("XYZ");
        $itemcode_mock_1->getName()->willReturn("An XYZ Item");
        $item_code1 = $itemcode_mock_1->reveal();

        $row_count = $sut->execute( $item_code1 );
        $this->assertEquals(1, $row_count);
    }


    public function testInvokationInsertion()
    {
        $logger = null;
        $sut = new InsertOrUpdateItemCode( $this->getPdo(), $logger, $GLOBALS['DB_TABLE_ITEMCODES'] );

        $itemcode_mock_1 = $this->prophesize( ItemCodeInterface::class );
        $itemcode_mock_1->getCode()->willReturn("XYZ");
        $itemcode_mock_1->getName()->willReturn("An XYZ Item");
        $item_code1 = $itemcode_mock_1->reveal();

        $row_count = $sut( $item_code1 );
        $this->assertEquals(1, $row_count);
    }


    public function testUpdate()
    {
        $logger = null;
        $sut = new InsertOrUpdateItemCode( $this->getPdo(), $logger, $GLOBALS['DB_TABLE_ITEMCODES'] );

        $itemcode_mock_1 = $this->prophesize( ItemCodeInterface::class );
        $itemcode_mock_1->getCode()->willReturn("XYZ");
        $itemcode_mock_1->getName()->willReturn("An XYZ Item");
        $item_code1 = $itemcode_mock_1->reveal();

        $row_count = $sut->execute( $item_code1 );
        $this->assertEquals(1, $row_count);

        // The LU key must exist
        $itemcode_mock_2 = $this->prophesize( ItemCodeInterface::class );
        $itemcode_mock_2->getCode()->willReturn("LU");
        $itemcode_mock_2->getName()->willReturn("A rewritten XYZ Item");
        $item_code2 = $itemcode_mock_2->reveal();

        $row_count = $sut->execute( $item_code2 );
        $this->assertEquals(2, $row_count);

    }


}
