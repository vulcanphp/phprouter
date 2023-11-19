<?php

namespace PhpScript\PhpRouter\Security;

use PhpScript\PhpRouter\Http\Request;
use PhpScript\PhpRouter\Http\Response;
use PhpScript\PhpRouter\Security\Interfaces\IMiddleware;

class Cros implements IMiddleware
{
    protected array $allowed = [];

    public function handle(Request $request, Response $response): void
    {
        if ($request->header('http-origin') !== null) {
            $response->headers([
                'Access-Control-Allow-Origin' => join(',', (array) $this->allowed['origin'] ?? []),
                'Access-Control-Allow-Credentials' => $this->allowed['credentials'] ?? '',
                'Access-Control-Max-Age' => $this->allowed['age'] ?? '',
            ]);
        }

        if ($request->isMethod('options')) {
            if ($request->header('http-access-control-request-method') !== null) {
                $response->header(['Access-Control-Allow-Methods' => join(',', (array) $this->allowed['methods'] ?? [])]);
            }

            if ($request->header('http-access-control-request-headers') !== null) {
                $response->header(['Access-Control-Allow-Headers' => join(',', (array) $this->allowed['headers'] ?? [])]);
            }

            exit(0);
        }
    }
}