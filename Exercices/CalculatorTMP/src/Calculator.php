<?php

namespace App;

class Calculator
{

    public function __construct(int $precision)
    {
        $this->setPrecision($precision);
    }

    public function setPrecision(int $precision): void
    {
        if ($precision > 0 && $precision < 4) $this->precision = $precision;
    }

    public function add(float $a, float $b): float
    {

        return $a + $b ;
    }
}
