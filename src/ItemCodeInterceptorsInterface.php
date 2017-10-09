<?php
namespace Germania\Nav\ItemCodes;

interface ItemCodeInterceptorsInterface extends ItemCodeProviderInterface
{

    /**
     * Sets the Item Code
     *
     * @var     null|ItemCodeProviderInterface $itemcode
     * @return  self
     */
    public function setItemCode( $itemcode );
}
