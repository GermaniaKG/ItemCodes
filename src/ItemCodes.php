<?php
namespace Germania\Nav\ItemCodes;

use Germania\Nav\ItemCodes\Exceptions\ItemCodeNotFoundException;

use Psr\Container\ContainerInterface;

class ItemCodes implements ContainerInterface, \Countable, \IteratorAggregate
{

    /**
     * @var ItemCodeInterface[]
     */
    public $item_codes = array();


    public function push (ItemCodeInterface $item )
    {
        $this->item_codes[ $item->getCode() ] = $item;
        return $this;
    }

    /**
     * @param  string $code
     * @return ItemCodeNotFoundException
     */
    public function get($code)
    {
        if (!$this->has($code)):
            throw new ItemCodeNotFoundException( "Could not find Item code '$code'." );
        endif;

        return $this->item_codes[ $code ];
    }

    /**
     * @param  string $code
     * @return boolean
     */
    public function has($code)
    {
        return array_key_exists($code, $this->item_codes);
    }


    /**
     * @return int
     */
    public function count()
    {
        return count($this->item_codes);
    }

    /**
     * @return ArrayIterator
     */
    public function getIterator()
    {
        return new \ArrayIterator( $this->item_codes );
    }
}
