<?php

class Square extends Rectangle
{
    public function __construct(float $a)
    {
        $this->setA($a);
    }

    public function getA(): float
    {
        return $this->a;
    }

    public function setA(float $a): Rectangle
    {
        $this->a = $a;
        $this->b = $a;
        return $this;
    }

    public function getB(): float
    {
        return $this->a;
    }

    public function setB(float $b): Rectangle
    {
        $this->setA($b);
        return $this;
    }
}