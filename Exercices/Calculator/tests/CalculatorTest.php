<?php
// Framework de tests PHPUNIT

use App\Calculator;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;

class CalculatorTest extends TestCase
{
   

    protected Calculator $calculator;

    public function setUp(): void
    {
        $this->calculator = new Calculator(2);
    }

    public function testPrecision(): void
    {
        $this->assertEquals( 2 , $this->calculator->getPrecision());
    }

   
    public function testInstanceOfCalculator(): void
    {
        $this->assertInstanceOf(Calculator::class, $this->calculator);
    }

    #[DataProvider('additionProvider')]
    public function testAdd($a, $b, $expected): void
    {

        $this->assertEquals($expected, $this->calculator->add($a, $b));
    }


    public function testExceptionDivision(): void
    {
        $this->expectException(\DivisionByZeroError::class);
        $this->calculator->division(3, 0);
    }

   
    public function testExceptionMessageDivision(): void
    {
        $this->expectExceptionMessage("Impossible de diviser par zéro");
        $this->calculator->division(3, 0);
    }

    static public function additionProvider(): array
    {
        return [
            [1, 2, 3],
            [0, 0, 0],
            [-1, 1, 0],
            [2.5, 3.5, 6.0],
            [10, -5, 5], // Exemple supplémentaire
        ];
    }

}
