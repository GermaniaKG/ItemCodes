<?php
namespace Germania\Nav\ItemCodes;


abstract class ItemCodeAbstract implements ItemCodeInterface
{

    /**
     * @var string
     */
    public $code;

    /**
     * @var string
     */
    public $name;

    /**
     * @var boolean
     */
    public $enabled;

    /**
     * @var boolean
     */
    public $display;



    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }


    /**
     * @return boolean
     */
    public function isEnabled()
    {
        return $this->enabled > 0;
    }

    /**
     * @return boolean
     */
    public function isDisplayable()
    {
        return $this->display > 0;
    }

}
