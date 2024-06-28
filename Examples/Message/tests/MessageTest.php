<?php
// Framework de tests PHPUNIT
use PHPUnit\Framework\TestCase;

use App\Message;

class MessageTest extends TestCase{

    protected Message $message;

    public function setUp():void{
        $this->message = new Message('en');
    }

    /**
     * @test langue en 
     */
    public function testLangEn(){

    }

    /**
     * @test langue fr 
     */
    public function testLangfr(){

    }
}
