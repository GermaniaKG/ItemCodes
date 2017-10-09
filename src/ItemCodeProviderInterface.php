<?php
namespace Germania\Nav\ItemCodes;

interface ItemCodeProviderInterface
{

    /**
     * Returns the Item code
     *
     * @return null|ItemCodeProviderInterface
     */
    public function getItemCode();
}
