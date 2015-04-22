<?php

namespace Atto;

class HttpKernal
{
    /**
     * Handle a Request and return a Response
     *
     * @param  Request $request
     * @return Response
     */
    public function handle(Request $request)
    {
        return new Response();
    }
}