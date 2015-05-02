<?php

namespace Atto;

class Route
{
    /**
     * @var string
     */
    protected $method;

    /**
     * @var string
     */
    protected $path;

    public function __construct($path, $method)
    {
        $this->setPath($path)->setMethod($method);
    }

    /**
     * Gets the value of method.
     *
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * Sets the value of method.
     *
     * @param string $method the method
     *
     * @return self
     */
    protected function setMethod($method)
    {
        $this->method = $method;

        return $this;
    }

    /**
     * Gets the value of path.
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Sets the value of path.
     *
     * @param string $path the path
     *
     * @return self
     */
    protected function setPath($path)
    {
        $this->path = $path;

        return $this;
    }
}