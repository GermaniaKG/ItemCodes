<?php
namespace Germania\Nav\ItemCodes;


class ItemCode extends ItemCodeAbstract implements ItemCodeInterface
{
    public function setCode( $code )
    {
        $this->code = $code;
        return $this;
    }

    public function setName( $name )
    {
        $this->name = $name;
        return $this;
    }

    public function setIsEnabled( $status )
    {
        $this->enabled = (bool) $status;
        return $this;
    }

    public function setIsDisplayable( $status )
    {
        $this->display = (bool) $status;
        return $this;
    }
}
