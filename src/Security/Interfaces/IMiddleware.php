<?php

namespace PhpScript\PhpRouter\Security\Interfaces;

use PhpScript\PhpRouter\Http\Request;
use PhpScript\PhpRouter\Http\Response;

interface IMiddleware
{
    /**
     * @return void 
     */
    public function handle(Request $request, Response $response): void;
}
