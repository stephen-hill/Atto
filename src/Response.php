<?php

namespace Atto;

class Response
{
    public $headers;
    public $content;
    public $version;

    /**
     * @var integer
     */
    protected $statusCode;

    /**
     * @var string
     */
    protected $statusMessage;
    public $charset;

    /**
     * Sourced from http://www.iana.org/assignments/http-status-codes/http-status-codes.xhtml
     * @var array
     */
    static protected $statuses = [
        100 => 'Continue',
        200 => 'OK',
        201 => 'Created',
        202 => 'Accepted',
        204 => 'No Content',
        301 => 'Moved Permanently',
        302 => 'Found',
        304 => 'Not Modified',
        307 => 'Temporary Redirect',
        308 => 'Permanent Redirect',
        400 => 'Bad Request',
        401 => 'Unauthorized',
        402 => 'Payment Required',
        403 => 'Forbidden',
        404 => 'Not Found',
        405 => 'Method Not Allowed',
        406 => 'Not Acceptable',
        408 => 'Request Timeout',
        409 => 'Conflict',
        411 => 'Length Required',
        429 => 'Too Many Requests',
        500 => 'Internal Server Error',
        503 => 'Service Unavailable',
        505 => 'HTTP Version Not Supported'
    ];

    public function __construct($content = '', $status = 200)
    {
        $this->content = $content;
        $this->statusCode = $status;

        $this->headers = new Collection();
        $this->version = '1.1';
        $this->charset = 'UTF-8';
    }

    private function sendHeaders()
    {
        // Check if the headers have already been sent
        if (headers_sent() === true)
        {
            return $this;
        }

        // HTTP Version and Status
        header(
            sprintf('HTTP/%s %s %s', $this->version, $this->statusCode, $this->statusMessage),
            true,
            $this->statusCode
        );

        // Send Headers
        foreach ($this->headers as $key => $value)
        {
            header($key, $value, false, $this->statusCode);
        }
    }

    public function send()
    {
        echo $this->content;

        return $this;
    }
}