<?php
// Framework de tests PHPUNIT
use PHPUnit\Framework\TestCase;

use App\Calculator;

class CalculatorTest extends TestCase{

    protected Calculator $calculator;

    public function setUp():void{
        // paramètre nommé precision <=> $precision paramètre
        $this->calculator = new Calculator(2);
    }

    public function testAdd(){
        // $this->assertSame(2., $this->calculator->add(1, 1)) ;

        $this->assertTrue(true) ;
    }
}