<?php

class Rectangle
{
    protected float $a;
    protected float $b;

    public function __construct(float $a, float $b) {
        $this->a = $a;
        $this->b = $b;
    }

    public function getA(): float
    {
        return $this->a;
    }

    public function setA(float $a): Rectangle
    {
        $this->a = $a;
        return $this;
    }

    public function getB(): float
    {
        return $this->b;
    }

    public function setB(float $b): Rectangle
    {
        $this->b = $b;
        return $this;
    }

    public function circumference(): float {
        return 2 * ($this->a + $this->b);
    }

    public function surface(): float {
        return $this->a * $this->b;
    }

    public function __toString(): string {
        return "a: " . $this->a . "; b: " . $this->b;
    }
}