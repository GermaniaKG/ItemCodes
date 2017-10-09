<?php
namespace Germania\Nav\ItemCodes\Filters;

use Germania\Nav\ItemCodes\ItemCodeInterface;

class DisplayableItemCodesFilterIterator extends \FilterIterator
{

    public function __construct( \Traversable $itemcodes )
    {
        parent::__construct( $itemcodes instanceOf \Iterator ? $itemcodes : $itemcodes->getIterator() );
    }


    public function accept()
    {
        $current = $this->getInnerIterator()->current();

        if ($current instanceOf ItemCodeInterface):
            return $current->isDisplayable();
        endif;

        return false;
    }
}
