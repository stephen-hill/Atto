<?php

use Atto\SymmetricCipher;

class SymmetricCipherTest extends PHPUnit_Framework_TestCase
{
    public function testInstanceType()
    {
        $sc = new SymmetricCipher('aes-128-cbc', 'Password');
        $this->assertInstanceOf('Atto\SymmetricCipher', $sc);
    }

    public function testEncryptDecrypt()
    {
        $sc = new SymmetricCipher('aes-128-cbc', 'Password');
        
        $a = $sc->encrypt('Hello World');
        $b = $sc->decrypt($a);
        
        $this->assertSame('Hello World', $b);
    }
}