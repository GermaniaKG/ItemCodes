<?php
namespace Germania\Nav\ItemCodes\Filters;

use Germania\Nav\ItemCodes\ItemCodeInterface;
use Germania\Nav\ItemCodes\ItemCodeProviderInterface;
use Germania\Nav\ItemCodes\ItemCode;
use Germania\Nav\ItemCodes\Exceptions\InvalidItemCodeArgumentException;

class ItemCodeFilterIterator extends \FilterIterator
{
    public $code;

    public function __construct( \Traversable $itemcode_providers, $code )
    {
        parent::__construct( $itemcode_providers instanceOf \Iterator ? $itemcode_providers : $itemcode_providers->getIterator() );

        if ($code instanceOf ItemCodeInterface):
            $this->code = $code;
        elseif(is_string( $code)):
            $this->code = new ItemCode;
            $this->code->setCode( $code );
        else:
            throw new InvalidItemCodeArgumentException;
        endif;
    }

    public function accept()
    {
        $current = $this->getInnerIterator()->current();

        if ($current instanceOf ItemCodeProviderInterface):
            $current_code = $current->getItemCode();

            $current_code_str = $current_code instanceOf ItemCodeInterface ? $current_code->getCode() : $current_code;

            return $current_code_str == $this->code->getCode();
        endif;

        return false;
    }
}
