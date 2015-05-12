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
    /**
     * Cached list of available cipher methods.
     * @var array
     */
    protected $ciphers;

    protected $cipher;

    protected $key;

    public function __construct($cipher, $key)
    {
        // Check the encryption cipher is valid
        if (in_array($cipher, $this->getCiphers()) === false)
        {
            throw new InvalidArgumentException(sprintf('The encryption cipher "%s" is invalid. Please check `getCiphers()` for a list of valid values.'));
        }

        // Check the encryption key is a string
        if (is_string($key) === false)
        {
            throw new InvalidArgumentException('The encryption key must be a string.');
        }

        // The
    }

    public function encrypt($data, $iv)
    {
        return openssl_encrypt($data, $this->cipher, $this->key, 0, $iv);
    }

    public function decrypt($data, $iv)
    {
        return openssl_decrypt($data, $this->cipher, $this->key, 0, $iv);
    }

    public function getNewInitializationVector()
    {
        return openssl_random_pseudo_bytes(openssl_cipher_iv_length($this->cipher));
    }

    /**
     * Get an array of valid cipher methods.
     *
     * @return array
     */
    public function getCiphers()
    {
        if ($this->ciphers === null)
        {
            $this->ciphers = openssl_get_cipher_methods(true);
        }

        return $ciphers;
    }
}