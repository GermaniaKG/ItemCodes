<?php
namespace Germania\Nav\ItemCodes;

interface ItemCodeInterface
{
    /**
     * @return string
     */
    public function getCode();

    /**
     * @return string
     */
    public function getName();

    /**
     * @return boolean
     */
    public function isEnabled();

    /**
     * @return boolean
     */
    public function isDisplayable();
}
