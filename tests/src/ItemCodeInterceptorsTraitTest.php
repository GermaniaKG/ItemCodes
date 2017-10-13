<?php
namespace tests;

use Germania\Nav\ItemCodes\ItemCodeInterface;
use Germania\Nav\ItemCodes\ItemCodeInterceptorsTrait;
use Germania\Nav\ItemCodes\ItemCodeProviderInterface;
use Germania\Nav\ItemCodes\Exceptions\InvalidItemCodeArgumentException;

class ItemCodeInterceptorsTraitTest extends \PHPUnit\Framework\TestCase
{
    public function testGetterAndSetter()
    {
        $mock = $this->getMockForTrait(ItemCodeInterceptorsTrait::class);

        $itemcode_mock = $this->prophesize( ItemCodeInterface::class );
        $itemcode_mock->getCode()->willReturn("XYZ");
        $itemcode = $itemcode_mock->reveal();

        // Make sure we are really changing the number here
        $this->assertNotEquals( $itemcode, $mock->getItemCode());

        $mock->setItemCode($itemcode);
        $this->assertEquals( $itemcode, $mock->getItemCode());
    }



    public function testSetterWithItemCodeProviderInterface()
    {
        $mock = $this->getMockForTrait(ItemCodeInterceptorsTrait::class);

        $itemcode_mock = $this->prophesize( ItemCodeInterface::class );
        $itemcode_mock->getCode()->willReturn("XYZ");
        $itemcode = $itemcode_mock->reveal();

        $this->assertNotEquals( $itemcode, $mock->getItemCode());

        $provider = $this->prophesize( ItemCodeProviderInterface::class );
        $provider->getItemCode()->willReturn( $itemcode );
        $mock->setItemCode( $provider->reveal() );

        $this->assertEquals( $itemcode, $mock->getItemCode());
        $this->assertInstanceOf( ItemCodeInterface::class, $mock->getItemCode());
    }

    public function testSetterWithStringItemCode()
    {
        $mock = $this->getMockForTrait(ItemCodeInterceptorsTrait::class);

        $mock->setItemCode( "foobar" );

        $this->assertInstanceOf( ItemCodeInterface::class, $mock->getItemCode());
    }


    /**
     * @dataProvider provideInvalidArguments
     */
    public function testInvalidArguments( $invalid )
    {
        $mock = $this->getMockForTrait(ItemCodeInterceptorsTrait::class);

        $this->expectException( InvalidItemCodeArgumentException::class, $mock->getItemCode());
        $this->expectException( \InvalidArgumentException::class, $mock->getItemCode());

        $mock->setItemCode( $invalid );


    }


    public function provideInvalidArguments()
    {
        return array(
            [ false ],
            [ 22 ]
        );
    }


}
