<?php

namespace App;

class Calculator
{
    private int $precision ;

    public function __construct(int $precision)
    {
        $this->precision = $precision ;
    }

    public function add(float $a, float $b): float
    {

        return round($a + $b, $this->precision);
    }

    public function division(float $a, float $b): float
    {

        if ($b == 0.0) throw new \DivisionByZeroError("Impossible de diviser par zéro");

        return round($a / $b, $this->precision);
    }

    /**
     * Get the value of precision
     */ 
    public function getPrecision():float
    {
        return $this->precision;
    }

    /**
     * Set the value of precision
     *
     * @return  self
     */ 
    public function setPrecision(float $precision):self
    {
        $this->precision = $precision;

        return $this;
    }
}
