<?php

namespace Atto;

class App
{
    protected $kernal;
    protected $request;

    public function __construct(HttpKernal $kernal, Request $request)
    {
        $this->kernal = $kernal;
        $this->request = $request;
    }

    public function run()
    {
        $response = $this->kernal->handle($this->request);
        $response->send();
        $this->kernal->terminate($request, $response);
    }
}