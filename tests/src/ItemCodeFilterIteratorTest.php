<?php
namespace tests;

use Germania\Nav\ItemCodes\ItemCodeInterface;
use Germania\Nav\ItemCodes\ItemCodeProviderInterface;
use Germania\Nav\ItemCodes\Filters\ItemCodeFilterIterator;
use Germania\Nav\ItemCodes\Exceptions\InvalidItemCodeArgumentException;

class ItemCodeFilterIteratorTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @dataProvider provideCodesAndExpectedResultCount
     */
    public function testSimple( $codes, $search, $expected_count)
    {
        $sut = new ItemCodeFilterIterator( new \ArrayObject($codes), $search );
        $this->assertEquals($expected_count, iterator_count( $sut ));
    }



    public function provideCodesAndExpectedResultCount()
    {
        $code = "ABC";
        $itemcode = $this->prophesize( ItemCodeInterface::class);
        $itemcode->getCode()->willReturn($code);
        $itemcode_stub = $itemcode->reveal();

        $provider = $this->prophesize( ItemCodeProviderInterface::class );
        $provider->getItemCode()->willReturn( $itemcode_stub );
        $provider_stub = $provider->reveal();

        return array(
            [ array($provider_stub), $code, 1],
            [ array($provider_stub), $itemcode_stub, 1],
            [ array("No_Itemcode"), $code, 0],
            [ array("No_Itemcode"), $itemcode_stub, 0],
            [ array($provider_stub), "no", 0],
        );
    }



    /**
     * @dataProvider provideCodesAndInvalidSearchThings
     */
    public function testExceptions( $codes, $invalid_search )
    {
        $this->expectException( InvalidItemCodeArgumentException::class );
        $this->expectException( \InvalidArgumentException::class );
       
        new ItemCodeFilterIterator( new \ArrayObject($codes), $invalid_search );
    }



    public function provideCodesAndInvalidSearchThings()
    {
        $code = "ABC";
        $itemcode = $this->prophesize( ItemCodeInterface::class);
        $itemcode->getCode()->willReturn($code);

        $provider = $this->prophesize( ItemCodeProviderInterface::class );
        $provider->getItemCode()->willReturn( $itemcode->reveal() );
        $provider_stub = $provider->reveal();

        return array(
            [ array($provider_stub), 1],
            [ array($provider_stub), array()],
            [ array($provider_stub), (object) array()],
        );
    }

}
