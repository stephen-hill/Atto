<?php

/*
The MIT License (MIT)

Copyright (c) 2015 Stephen Hill

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
*/

namespace Atto;

use InvalidArgumentException;

class SymmetricCipher
{
    protected $cipher;

    protected $key;

    public function __construct($cipher, $key)
    {
        // Check the encryption cipher is valid
        if (in_array($cipher, openssl_get_cipher_methods(true)) === false)
        {
            throw new InvalidArgumentException(sprintf('The encryption cipher "%s" is invalid. Please check `openssl_get_cipher_methods()` for a list of valid values.'));
        }

        // Check the encryption key is a string
        if (is_string($key) === false)
        {
            throw new InvalidArgumentException('The encryption key must be a string.');
        }
        
        // Check the key length is not zero
        if (strlen($key) < 1)
        {
            throw new InvalidArgumentException('The encryption key cannot be empty.');
        }

        $this->cipher = $cipher;
        
        // Hash the key
        $this->key = openssl_digest($key, 'sha256', true);
    }

    public function encrypt($data)
    {
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($this->cipher));
        $encrypted = openssl_encrypt($data, $this->cipher, $this->key, OPENSSL_RAW_DATA, $iv);
        
        return base64_encode($iv . $encrypted);
    }

    public function decrypt($data)
    {
        $data = base64_decode($data);
        $length = openssl_cipher_iv_length($this->cipher);
        $iv = substr($data, 0, $length);
        $encrypted = substr($data, $length);
        
        return openssl_decrypt($encrypted, $this->cipher, $this->key, OPENSSL_RAW_DATA, $iv);
    }
}