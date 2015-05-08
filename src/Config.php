<?php

namespace Atto;

use Exception;
use InvalidArgumentException;

class Config
{
    /**
     * @var string
     */
    protected $path;

    /**
     * @var boolean
     */
    protected $loaded = false;

    /**
     * @var array|null
     */
    protected $data;

    /**
     * @var array
     */
    protected $cache = [];

    /**
     * @param string $path Full or relative path of the config file.
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

        // Try and find the data
        if (array_key_exists($key, $this->data) === true)
        {
            return $this->cache[$key] = $this->data[$key];
        }

        if ($default === null)
        {
            throw new Exception(sprintf('Key %s not found in %s.', $key, $this->path));
        }

        return $default;
    }

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