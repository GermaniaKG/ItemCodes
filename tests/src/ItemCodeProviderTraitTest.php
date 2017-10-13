<?php
namespace tests;

use Germania\Nav\ItemCodes\ItemCodeProviderTrait;
use Germania\Nav\ItemCodes\ItemCodeInterface;

class ItemCodeProviderTraitTest extends \PHPUnit\Framework\TestCase
{


    public function testGetInterceptor()
    {
        $mock = $this->getMockForTrait( ItemCodeProviderTrait::class );

        $itemcode_mock = $this->prophesize( ItemCodeInterface::class );
        $itemcode_mock->getCode()->willReturn("XYZ");
        $itemcode = $itemcode_mock->reveal();

        // Trait introduces this attribute
        $this->assertObjectHasAttribute('itemcode', $mock);
        $mock->itemcode = $itemcode;

        // Injected itemcode and getter result must match
        $this->assertEquals( $itemcode, $mock->getItemCode());
        $this->assertSame( $itemcode, $mock->getItemCode());
    }
}
