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

use Exception;
use InvalidArgumentException;

/**
 * Class for reading values from JSON configuration files.
 *
 * @author Stephen Hill stephen@gatekiller.co.uk
 * @license http://opensource.org/licenses/MIT MIT
 */
class Config
{
    /**
     * Full or relative path of the config file.
     *
     * @var string
     */
    protected $path;

    /**
     * Changed to TRUE is the config file has been loaded to memory.
     *
     * @var boolean
     */
    protected $loaded = false;

    /**
     * The JSON data converted into an array.
     *
     * @var array
     */
    protected $data;

    /**
     * Cache for ->get($key) calls.
     *
     * @var array
     */
    protected $cache = [];

    /**
     * @param string $path Full or relative path of the config file.
     * @throws InvalidArgumentException Throws an InvalidArgumentException if
     *                                  the $path argument is not a string.
     */
    public function __construct($path)
    {
        // Path must be a string
        if (is_string($path) === false)
        {
            throw new InvalidArgumentException('Argument $path must be a string.');
        }

        $this->path = $path;
    }

    /**
     * Get the value of a configuration key.
     * Nested keys can be specified in dot notation.
     *
     * @param string $key The string of the key.
     * @param mixed $default This is returned if the key does not exist.
     * @return mixed Returns the value the key holds.
     * @throws Exception Throws an exception is the key does not exist
     *                   and a default is not defined.
     */
    public function get($key, $default = null)
    {
        // Check the cache
        if (array_key_exists($key, $this->cache) === true)
        {
            return $this->cache[$key];
        }

        // Load the config file if not already done so
        if ($this->loaded === false)
        {
            $this->load();
        }

        // Split the key segments into an array
        $segments = explode('.', $key);
        $data = $this->data;
        $value = null;

        // Try and find the data
        foreach ($segments as $segment)
        {
            if (isset($data[$segment]) === true)
            {
                $data = $value = $data[$segment];
                continue;
            }
        }

        if ($value !== null)
        {
            return $this->cache[$key] = $value;
        }

        if ($default === null)
        {
            throw new Exception(sprintf('Key %s not found in %s.', $key, $this->path), 1);
        }

        return $default;
    }

    /**
     * Loads the config file from disk and converts the JSON to an array.
     * @return void
     * @throws Exception Throws an Exception is the config file does not exist.
     * @throws Exception Throws an Exception if there is a JSON parsing error.
     */
    protected function load()
    {
        // Check if the config file exists
        if (file_exists($this->path) === false)
        {
            throw new Exception(sprintf('File %s does not exist.', $this->path));
        }

        $raw = file_get_contents($this->path);
        $json = json_decode($raw, true);

        if (json_last_error() !== JSON_ERROR_NONE)
        {
            throw new Exception(json_last_error_msg());
        }

        $this->data = $json;
        $this->loaded = true;
    }
}