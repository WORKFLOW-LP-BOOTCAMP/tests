<?php 
use PHPUnit\Framework\TestCase as TestCase;
use App\Message;

class MessageTest extends TestCase{

    protected Message $message;

    // méthode qui s'exécute avant chaque test
    public function setUp():void{
        $this->message = new Message('en');
    }

    // un test, c'est une méthode prefixé par test.
    public function testMessageEn(){
        $this->assertSame("Hello World!",$this->message->get());
    }

    public function testMessageFr(){
        $this->message->setLang('fr');
            
        $this->assertSame("Bonjour les gens!",$this->message->get());
    }

    public function testInversePhrase(){

        $this->assertSame('olleH', $this->message->inverse('Hello'));

    }
}