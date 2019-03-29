<?php

namespace App\UI\Middleware;

use Fig\Http\Message\StatusCodeInterface as StatusCode;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Server\MiddlewareInterface;
use Zend\Diactoros\Response\RedirectResponse;

class StripTrailingSlashMiddleware implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $uri = $request->getUri();
        $path = $uri->getPath();

        if ($path !== '/'
            && preg_match('/\/$/', $path)
        ) {
            return new RedirectResponse(
                $uri->withPath(rtrim($path, '/')),
                StatusCode::STATUS_MOVED_PERMANENTLY
            );
        }

        return $handler->handle($request);
    }
}
