<?php
namespace tests;

use Germania\Nav\ItemCodes\ItemCode;

class ItemCodeTest extends \PHPUnit_Framework_TestCase
{

    public function testInstantiation()
    {
        $sut = new ItemCode;

        $value = "foo";
        $this->assertEquals( $sut->setCode($value)->getCode(), $value);
        $this->assertEquals( $sut->setName($value)->getName(), $value);

        $this->assertTrue( $sut->setIsEnabled( true )->isEnabled());
        $this->assertFalse( $sut->setIsEnabled( false )->isEnabled());

        $this->assertTrue( $sut->setIsDisplayable( true )->isDisplayable());
        $this->assertFalse( $sut->setIsDisplayable( false )->isDisplayable());

    }


}
