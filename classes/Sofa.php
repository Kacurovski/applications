<?php

class Sofa extends Furniture implements Printable
{
    private $seats;
    private $armrests;
    private $legth_opened;

    public function __construct($width, $length, $height)
    {
        parent::__construct($width, $length, $height);
    }

    public function setSeats($seats)
    {
        $this->seats = $seats;
    }

    public function getSeats() 
    {
        return $this->seats;
    }

    public function setArmrests($armrests)
    {
        $this->armrests = $armrests;
    }

    public function getArmrests() {
        return $this->armrests;
    }

    public function setLegthOpened($legth_opened)
    {
        $this->legth_opened = $legth_opened;
    }

    public function getLegthOpened() 
    {
        return $this->legth_opened;
    }

    public function area_opened() {
        if ($this->getIsForSleeping()) {
            $total = $this->getWidth() * $this->getLegthOpened();
            return "Area Opened: {$total}";
        } else {
            echo "This sofa is for sitting only, it has {$this->armrests} armrests and {$this->seats} seats";
        }
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