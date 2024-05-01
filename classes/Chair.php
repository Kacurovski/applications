<?php

class Chair extends Furniture implements Printable
{

    public function __construct($width, $length, $height)
    {
        parent::__construct($width, $length, $height);
    }

    public function print()
    {
        $className = get_class($this);
        $sleepingStatus = $this->getIsForSleeping() ? 'sleeping' : 'sitting only';
        $area = $this->area();
        echo "$className, $sleepingStatus, $area cm2";
    }

    public function sneakpeek()
    {
        echo get_class($this);
    }

    public function fullinfo()
    {
        $className = get_class($this);
        $sleepingStatus = $this->getIsForSleeping() ? 'sleeping' : 'sitting only';
        $area = $this->area();
        $width = $this->getWidth();
        $length = $this->getLength();
        $height = $this->getHeight();
        echo "$className, $sleepingStatus, $area cm2, width: $width cm, length: $length cm, height: $height cm";
    }
    
}


?>