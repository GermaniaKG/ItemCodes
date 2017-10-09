<?php
namespace Germania\Nav\ItemCodes;

trait ItemCodeProviderTrait
{

    /**
     * @var ItemCodeProviderInterface
     */
    public $itemcode;

    /**
     * Returns the ItemCode
     *
     * @return null|ItemCodeProviderInterface
     */
    public function getItemCode()
    {
        return $this->itemcode;
    }
}
