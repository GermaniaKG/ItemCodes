<?php
namespace tests;

use tests\DatabaseTestCaseAbstract;

use Germania\Nav\ItemCodes\ItemCodes;
use Germania\Nav\ItemCodes\ItemCodeInterface;
use Germania\Nav\ItemCodes\Filters\DisplayableItemCodesFilterIterator;

class DisplayableItemCodesFilterIteratorTest extends \PHPUnit\Framework\TestCase
{
    public function testFilter()
    {
        $item_codes = new ItemCodes;

        // Should be empty right at the beginning
        $this->assertEquals(0, count($item_codes));


        $itemcode_mock_1 = $this->prophesize( ItemCodeInterface::class );
        $itemcode_mock_1->getCode()->willReturn("XYZ");
        $itemcode_mock_1->isDisplayable()->willReturn(true);
        $item_code1 = $itemcode_mock_1->reveal();

        $itemcode_mock_2 = $this->prophesize( ItemCodeInterface::class );
        $itemcode_mock_2->getCode()->willReturn("ABC");
        $itemcode_mock_2->isDisplayable()->willReturn(false);
        $item_code2 = $itemcode_mock_2->reveal();

        // Push two items
        $item_codes->push($item_code1);
        $item_codes->push($item_code2);
        // Cheat sowthing wrong into container
        $item_codes->item_codes[] = "foobar";

        $this->assertEquals(3, iterator_count($item_codes));

        $sut = new DisplayableItemCodesFilterIterator( $item_codes );
        $this->assertEquals(1, iterator_count($sut));

    }
}
