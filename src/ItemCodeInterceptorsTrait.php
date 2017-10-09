<?php
namespace Germania\Nav\ItemCodes;

use Germania\Nav\ItemCodes\Exceptions\InvalidItemCodeArgumentException;

trait ItemCodeInterceptorsTrait
{
    use ItemCodeProviderTrait;


    /**
     * Sets the Item Code.
     *
     * @var     null|ItemCodeProviderInterface $itemcode
     * @return  self
     */
    public function setItemCode( $itemcode )
    {
        if ($itemcode instanceOf ItemCodeProviderInterface):
            $this->itemcode = $itemcode->getItemCode();
        elseif ($itemcode instanceOf ItemCodeInterface):
            $this->itemcode = $itemcode;

        elseif (is_string($itemcode)):
            // Convert string to ItemCode instance
            $ni = new ItemCode;
            $ni->setCode( $itemcode )->setName( $itemcode );

            $this->itemcode = $ni;

        else:
            throw new InvalidItemCodeArgumentException("ItemCodeInterface or Item code string expected.");
        endif;

        return $this;
    }
}
